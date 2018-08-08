<?php 

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Session;
use app\Repositories\UserModuleRepository;

use Auth;
use Validator;
use Mail;
use Modules\User\Emails\PasswordChange;
use App\Jobs\SendPasswordChangedEmail;

class UserController extends Controller{
	private $userModuleRepo;

	public function __construct(
		
		UserModuleRepository $userModuleRepo
	){
		$this->userModuleRepo = $userModuleRepo;
	}

	/**
	* Display a listing of the resource.
	* @return Response
	*/
	public function index(){
		Session::put('menu','user');
		$users = $this->userModuleRepo->getAllUser($limit = 10);
		
		
		$userModuleRepo = $this->userModuleRepo;
		return view('user::user.index',compact('users','userModuleRepo'));
	}

	/**
	* Show the form for creating a new resource.
	* @return Response
	*/
	public function create(){
		return view('user::user.create');
	}

	/**
	* Store a newly created resource in storage.
	* @param  Request $request
	* @return Response
	*/
	public function store(Request $request){
		//validate password 
		Validator::validate($request->all(), [
            'password' => 'required|min:6',
        ]);
		$this->userModuleRepo->createUser($request->all());
		Session::flash('success','Operation Success');
		return redirect('admin/user/user');
	}

	/**
	* Show the specified resource.
	* @return Response
	*/
	public function show(){
		return view('user::user.show');
	}

	/**
	* Show the specified resource.
	* @return Response
	*/
	public function edit($id){
		Session::flash('error','User cannot be edited');
		return back();
		$user = $this->userModuleRepo->getUserById($id);
		return view('user::user.edit',compact('user'));
	}

	/**
	* Update the specified resource in storage..
	* Request $request
	* @return Response
	*/
	public function update($id ,Request $request){
		$this->userModuleRepo->updateUser($id,$request->all());
		Session::flash('success','Operation Success');
		return redirect('admin/user/user');
	}

	/**
	* Remove the specified resource from storage.
	* @return Response
	*/
	public function delete($id){
		$this->userModuleRepo->deleteUser($id);
		Session::flash('success','Operation Success');
		return redirect('admin/user/user');
	}

	/**
	* Remove the specified resource from user but not form storage.
	* @return Response
	*/
	public function softDelete($id){
		$this->userModuleRepo->softDeleteUser($id);
		Session::flash('success','Operation Success');
		return redirect('admin/user/user');
	}

	/**
	* Remove the Multiple resource from storage.
	* @return Response
	*/
	public function deleteMultiple(Request $request){
		dd($request->all);
		$checkeds = $request->only('checked')['checked'];
		if(count($checkeds)<=0){
			Session::flash('error','Item is not selected');
			return back();
		}
		foreach($checkeds as $checked){
			$this->userModuleRepo->deleteUser($checked);
		}
		Session::flash('success','Operation Success');
		return redirect('admin/user/user');
	}

	/**
	* Export table related to this module.
	* @return Response
	*/
	public function export(){
		$this->userModuleRepo->export(['users']);
	}

	public function changePassword(Request $request){
		//dd($request->all());
		//cheak this user and who change password belong to same organixation or not
		

		//validate password 
		Validator::validate($request->all(), [
            'password' => 'required|min:6',
        ]);
		//now change password
		if($this->userModuleRepo->changePassword($request->all())){
	    	Session::flash('success','Password is changed successfully');
	    	//Now send Password change password-----
	    	$user = $this->userModuleRepo->getUserById($request['user_id']);
	    	Mail::to($user['email'])->send(new PasswordChange($user,$request['password']));
	    	//dispatch(new SendPasswordChangedEmail($user),$request['password']);
			return redirect('admin/user/user');
		}
	}

	public function pushOrganizationToSession($organization_id){
        Session::put('organization_id',$organization_id);
        return back();
    }
}
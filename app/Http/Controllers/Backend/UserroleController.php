<?php 

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Session;
use app\Repositories\UserModuleRepository;
use Auth;
use DB;

class UserroleController extends Controller{
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
		Session::put('menu','userrole');
		$userroles = $this->userModuleRepo->getAllUserrole($limit = 10);
		return view('user::userrole.index',compact('userroles'));
	}

	/**
	* Show the form for creating a new resource.
	* @return Response
	*/
	public function create($user_id){
		Session::put('user_id',$user_id);
		$my_users = $this->userModuleRepo->getAllUser();
		if(!isSuperAdmin(Auth::user()['id'])){
			$my_users = $this->userModuleRepo->getUserByOrganization(Auth::user()['organization_id']);
		}
		$roles = $this->userModuleRepo->getAllRole();
		return view('user::userrole.create',compact('my_users','roles'));
	}

	/**
	* Store a newly created resource in storage.
	* @param  Request $request
	* @return Response
	*/
	public function store(Request $request){
		//supper admin should not be assgin to other email
        $superAdminEmail = DB::table('users')->where('id',$request['user_id'])->first();
        $role = DB::table('roles')->where('id',$request['role_id'])->first();
        if($superAdminEmail['email']!='me.suman11@gmail.com'&&$role['name']=='SuperAdmin'){
            Session::flash('error','Sorry you cannot assign SuperAdmin');
            return back();
        }
		if($this->userModuleRepo->isRoleAssignAlready($request['user_id'],$request['role_id'])){
			Session::flash('error','Role is already assigned to this user');
			return back();
		}
		$this->userModuleRepo->createUserrole($request->all());
		Session::flash('success','Operation Success');
		return redirect('admin/user/user');
	}

	/**
	* Show the specified resource.
	* @return Response
	*/
	public function show(){
		return view('user::userrole.show');
	}

	/**
	* Show the specified resource.
	* @return Response
	*/
	public function edit($id){
		$userrole = $this->userModuleRepo->getUserroleById($id);
		return view('user::userrole.edit',compact('userrole'));
	}

	/**
	* Update the specified resource in storage..
	* Request $request
	* @return Response
	*/
	public function update($id ,Request $request){
		$this->userModuleRepo->updateUserrole($id,$request->all());
		Session::flash('success','Operation Success');
		return redirect('admin/user/userrole');
	}

	/**
	* Remove the specified resource from storage.
	* @return Response
	*/
	public function delete($id){
		if($this->userModuleRepo->checkLastAdminOrNot($id)){
			Session::flash('error','Sorry!! Organization need at least one Admin');
			return back();
		}
		$this->userModuleRepo->deleteUserrole($id);
		Session::flash('success','Operation Success');
		//return redirect('admin/user/userrole');
		return back();
	}

	/**
	* Remove the specified resource from user but not form storage.
	* @return Response
	*/
	public function softDelete($id){
		$this->userModuleRepo->softDeleteUserrole($id);
		Session::flash('success','Operation Success');
		//return redirect('admin/user/userrole');
		return back();
	}

	/**
	* Remove the Multiple resource from storage.
	* @return Response
	*/
	public function deleteMultiple(Request $request){
		$checkeds = $request->only('checked')['checked'];
		if(count($checkeds)<=0){
			Session::flash('error','Item is not selected');
			return back();
		}
		foreach($checkeds as $checked){
			$this->userModuleRepo->deleteUserrole($checked);
		}
		Session::flash('success','Operation Success');
		//return redirect('admin/user/userrole');
		return back();
	}

	/**
	* Export table related to this module.
	* @return Response
	*/
	public function export(){
		$this->userModuleRepo->export(['userroles']);
	}

}
<?php 

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Session;
use app\Repositories\UserModuleRepository;


class RoleController extends Controller{
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
		Session::put('menu','role');
		$roles = $this->userModuleRepo->getAllRole($limit = 10);
		//dd($roles);
		return view('user::role.index',compact('roles'));
	}

	/**
	* Show the form for creating a new resource.
	* @return Response
	*/
	public function create(){
		return view('user::role.create');
	}

	/**
	* Store a newly created resource in storage.
	* @param  Request $request
	* @return Response
	*/
	public function store(Request $request){
		$this->userModuleRepo->createRole($request->all());
		Session::flash('success','Operation Success');
		return redirect('admin/user/role');
	}

	/**
	* Show the specified resource.
	* @return Response
	*/
	public function show(){
		return view('user::role.show');
	}

	/**
	* Show the specified resource.
	* @return Response
	*/
	public function edit($id){
		$role = $this->userModuleRepo->getRoleById($id);
		return view('user::role.edit',compact('role'));
	}

	/**
	* Update the specified resource in storage..
	* Request $request
	* @return Response
	*/
	public function update($id ,Request $request){
		$this->userModuleRepo->updateRole($id,$request->all());
		Session::flash('success','Operation Success');
		return redirect('admin/user/role');
	}

	/**
	* Remove the specified resource from storage.
	* @return Response
	*/
	public function delete($id){
		$this->userModuleRepo->deleteRole($id);
		Session::flash('success','Operation Success');
		return redirect('admin/user/role');
	}

	/**
	* Remove the specified resource from user but not form storage.
	* @return Response
	*/
	public function softDelete($id){
		$this->userModuleRepo->softDeleteRole($id);
		Session::flash('success','Operation Success');
		return redirect('admin/user/role');
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
			$this->userModuleRepo->deleteRole($checked);
		}
		Session::flash('success','Operation Success');
		return redirect('admin/user/role');
	}

	/**
	* Export table related to this module.
	* @return Response
	*/
	public function export(){
		$this->userModuleRepo->export(['roles']);
	}

}
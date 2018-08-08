<?php 

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Session;
use App\Repositories\PaintModuleRepository;


class ImageController extends Controller{
	private $paintModuleRepo;

	public function __construct(
		PaintModuleRepository $paintModuleRepo
	){
		$this->paintModuleRepo = $paintModuleRepo;
	}

	/**
	* Display a listing of the resource.
	* @return Response
	*/
	public function index(){
		Session::put('menu','image');
		$images = $this->paintModuleRepo->getAllImage($limit = 10);
		return view('paint::image.index',compact('images'));
	}

	/**
	* Show the form for creating a new resource.
	* @return Response
	*/
	public function create(){
		return view('paint::image.create');
	}

	/**
	* Store a newly created resource in storage.
	* @param  Request $request
	* @return Response
	*/
	public function store(Request $request){
		$image=$this->paintModuleRepo->createImage($request->all());
		Session::flash('success','Operation Success');
		return redirect()->route('home', ['id' => $image->id]);
	}

	/**
	* Show the specified resource.
	* @return Response
	*/
	public function show(){
		return view('paint::image.show');
	}

	/**
	* Show the specified resource.
	* @return Response
	*/
	public function edit($id){
		$image = $this->paintModuleRepo->getImageById($id);
		return view('paint::image.edit',compact('image'));
	}

	/**
	* Update the specified resource in storage..
	* Request $request
	* @return Response
	*/
	public function update($id ,Request $request){
		$this->paintModuleRepo->updateImage($id,$request->all());
		Session::flash('success','Operation Success');
		return redirect('admin/paint/image');
	}

	/**
	* Remove the specified resource from storage.
	* @return Response
	*/
	public function delete($id){
		$this->paintModuleRepo->deleteImage($id);
		Session::flash('success','Operation Success');
		return redirect('admin/paint/image');
	}

	/**
	* Remove the specified resource from user but not form storage.
	* @return Response
	*/
	public function softDelete($id){
		$this->paintModuleRepo->softDeleteImage($id);
		Session::flash('success','Operation Success');
		return redirect('admin/paint/image');
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
			$this->paintModuleRepo->deleteImage($checked);
		}
		Session::flash('success','Operation Success');
		return redirect('admin/paint/image');
	}

	/**
	* Export table related to this module.
	* @return Response
	*/
	public function export(){
		$this->paintModuleRepo->export(['images']);
	}

}
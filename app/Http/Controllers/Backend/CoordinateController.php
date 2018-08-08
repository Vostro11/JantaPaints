<?php 

namespace app\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Session;
use App\Repositories\PaintModuleRepository;
use DB;

class CoordinateController extends Controller{
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
		Session::put('menu','coordinate');
		$coordinates = $this->paintModuleRepo->getAllCoordinate($limit = 10);
		return view('paint::coordinate.index',compact('coordinates'));
	}

	/**
	* Show the form for creating a new resource.
	* @return Response
	*/
	public function create(){
		return view('paint::coordinate.create');
	}

	/**
	* Store a newly created resource in storage.
	* @param  Request $request
	* @return Response
	*/
	public function store(Request $request){
		$this->paintModuleRepo->createCoordinate($request->all());
		Session::flash('success','Operation Success');
		return redirect('admin/paint/coordinate');
	}

	public function storeMultipleCoordinat(Request $request){
		//dd($request->all());
		//delete old coordinat of this image if exist
		//DB::table('coordinates')->where('image_id',$request['image_id'])->delete();
		// add new coordintae-----
		foreach($request['coordinate'] as $coordinate){
			$coordinateData['image_id'] = $request['image_id'];
			$coordinateData['coordinate'] = $coordinate;
			$coordinateData['color_id'] = 1;
			$coordinateData['label'] = 'label';
			$this->paintModuleRepo->createCoordinate($coordinateData);
			
		}
		Session::flash('success','Operation Success');
		return redirect()->route('image-processing', ['id' => $request['image_id']]);
		// return redirect('image-processing/'.$request['image_id']);
	}

	/**
	* Show the specified resource.
	* @return Response
	*/
	public function show(){
		return view('paint::coordinate.show');
	}

	/**
	* Show the specified resource.
	* @return Response
	*/
	public function edit($id){
		$coordinate = $this->paintModuleRepo->getCoordinateById($id);
		return view('paint::coordinate.edit',compact('coordinate'));
	}

	/**
	* Update the specified resource in storage..
	* Request $request
	* @return Response
	*/
	public function update($id ,Request $request){
		$this->paintModuleRepo->updateCoordinate($id,$request->all());
		Session::flash('success','Operation Success');
		return redirect('admin/paint/coordinate');
	}

	/**
	* Remove the specified resource from storage.
	* @return Response
	*/
	public function delete($id){
		$this->paintModuleRepo->deleteCoordinate($id);
		Session::flash('success','Operation Success');
		return redirect('admin/paint/coordinate');
	}

	/**
	* Remove the specified resource from user but not form storage.
	* @return Response
	*/
	public function softDelete($id){
		$this->paintModuleRepo->softDeleteCoordinate($id);
		Session::flash('success','Operation Success');
		return redirect('admin/paint/coordinate');
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
			$this->paintModuleRepo->deleteCoordinate($checked);
		}
		Session::flash('success','Operation Success');
		return redirect('admin/paint/coordinate');
	}

	/**
	* Export table related to this module.
	* @return Response
	*/
	public function export(){
		$this->paintModuleRepo->export(['coordinates']);
	}

}
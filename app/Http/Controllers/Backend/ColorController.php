<?php 

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Session;
use app\Repositories\PaintModuleRepository;
use Excel;


class ColorController extends Controller{
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
		Session::put('menu','color');
		$colors = $this->paintModuleRepo->getAllColor($limit = 10);
		return view('paint::color.index',compact('colors'));
	}

	/**
	* Show the form for creating a new resource.
	* @return Response
	*/
	public function create(){
		return view('paint::color.create');
	}

	/**
	* Store a newly created resource in storage.
	* @param  Request $request
	* @return Response
	*/
	public function store(Request $request){
		$this->paintModuleRepo->createColor($request->all());
		Session::flash('success','Operation Success');
		return redirect('admin/paint/color');
	}

	/**
	* Show the specified resource.
	* @return Response
	*/
	public function show(){
		return view('paint::color.show');
	}

	/**
	* Show the specified resource.
	* @return Response
	*/
	public function edit($id){
		$color = $this->paintModuleRepo->getColorById($id);
		return view('paint::color.edit',compact('color'));
	}

	/**
	* Update the specified resource in storage..
	* Request $request
	* @return Response
	*/
	public function update($id ,Request $request){
		$this->paintModuleRepo->updateColor($id,$request->all());
		Session::flash('success','Operation Success');
		return redirect('admin/paint/color');
	}

	/**
	* Remove the specified resource from storage.
	* @return Response
	*/
	public function delete($id){
		$this->paintModuleRepo->deleteColor($id);
		Session::flash('success','Operation Success');
		return redirect('admin/paint/color');
	}

	/**
	* Remove the specified resource from user but not form storage.
	* @return Response
	*/
	public function softDelete($id){
		$this->paintModuleRepo->softDeleteColor($id);
		Session::flash('success','Operation Success');
		return redirect('admin/paint/color');
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
			$this->paintModuleRepo->deleteColor($checked);
		}
		Session::flash('success','Operation Success');
		return redirect('admin/paint/color');
	}

	/**
	* Export table related to this module.
	* @return Response
	*/
	public function export(){
		$this->paintModuleRepo->export(['colors']);
	}

	public function importGet(){
		return 1;
	}

	public function importPost(Request $request){
		if($request->hasFile('file')){
			Excel::load($request->file, function($reader) {
				$results = $reader->toArray();
				// dd(array_slice($results[0],0,100));
				// $headings = $results->getHeading();
				$combo = [];
				foreach ($results as $value) {
					if(array_key_exists('r' , $value) && array_key_exists('g' , $value) && array_key_exists('b' , $value)){
						if(is_numeric($value['r']) && is_numeric($value['g']) && is_numeric($value['b'])){
							
							echo "<span style='color:red;'>Name = </span>".$value['shade_name'];
							echo " <span style='color:green;'><b>Code = </b></span>".$value['shade_code'];
							echo  '<span style="color:blue;">rgb = </span>'.$value['r'].','.$value['g'].','.$value['b'].'<br>';
						
							$color = [];

							$color['type'] = "Formulae";
							$color['sno'] = (int)$value['sr.no'];
							$color['shade_name'] = $value['shade_name'];
							$color['shade_code'] = $value['shade_code'];
							$color['rgb'] = 'rgb('.$value['r'].','.$value['g'].','.$value['b'].')';
							array_push($combo, $color);
						}
					}
					
				// 
				}
				// $unique = array_unique($combo,SORT_REGULAR);
				// $unique = array_intersect_key( $combo , array_unique( array_map('serialize' , $combo ) ) );
				echo 'combo = '.sizeof($combo);
				// echo 'unique = '.sizeof($unique);
				// dd($combo);
				$this->paintModuleRepo->createColor($combo);	

dd(sizeof($combo));
			});
		}

		Session::flash('success','Operation Success');
		return redirect('admin/paint/color/all');
		
		
		return $request->all();
	}

	public function showAllColor(){

		$colors = $this->paintModuleRepo->getAllColor();
		$unique = $colors->unique('shade_code');
		
		// $this->paintModuleRepo->deleteAllColor();
		// $this->paintModuleRepo->createColor($unique->toArray());
		// $colors = $this->paintModuleRepo->getAllColor();
		
		// echo 'total = '.$colors->count();
		// echo 'unique = '.$unique->count();

		// dd($colors);
		// dd('shade_name');
		return view('paint::color.all',compact('colors'));
	}

}
<?php 
namespace App\Repositories;

use DB;
use Excel;
use Image;
class PaintModuleRepository extends PaintServiceEloquent{
	public function export(array $tables){
		$datas = array();
		//prepared datas ------------------
		foreach($tables as $table){
			$tempData = DB::table($table)->get();
			array_push($datas,$tempData);
		}
		//$datas =json_decode( json_encode($datas), true);
		//file name according to modules
		$filename = 'Paint';
		Excel::create($filename, function($excel) use ($datas,$filename,$tables) {
			$sheetNames = $tables;
			$i = 0;
			// loop table to create sheet
			foreach ($datas as $data) {
				$excel->sheet($sheetNames[$i], function($sheet) use($data,$sheetNames) {
					$sheet->fromArray($data);
				});
				$i++;
			}
		})->export('xls');
	}

	public function createImage(array $attributes){
		if(array_key_exists('image', $attributes)){
			$path = $this->uploadImage($attributes['image'],$width=640, $height=425);
			$attributes['image']=$path;
		}
		return $this->image->create($attributes);
	}

	public function updateImage($id,array $attributes){
		if(array_key_exists('image', $attributes)){
			$image = $this->image->findorfail($id);
			//delete image
			if($image['image']!='' && file_exists($image['image'])){ 				
				unlink($image['image']);
			}
			$path = $this->uploadImage($attributes['image'],$width=640, $height=425);
			$attributes['image']=$path;
		}
		return $this->image->findorfail($id)->update($attributes);
	}

	public function deleteImage($id){
		$image = $this->image->findorfail($id);
		//delete image 
		if($image['image']!='' && file_exists($image['image'])){
			unlink($image['image']);
		}
		return $this->image->findorfail($id)->delete();
	}

	private function uploadImage($file,$width=null,$height=null){
		if($file){
			$extension = $file->getClientOriginalExtension();
			$filename= md5(microtime()).'.'.$extension;
			$destinationPath= 'uploads/image/';
			$file->move($destinationPath,$filename);
			if($width!=null && $height!=null){
				Image::make($destinationPath.$filename)
	            ->resize( $width, $height )//note width x height		
	            ->text('water',100,100,function($font) {
								    //$font->file('foo/bar.ttf');
								    $font->size(200);
								    $font->color(array(255, 255, 255, 0.5));
								    $font->align('center');
								    $font->valign('top');
								    $font->angle(45);
								})
	            ->save($destinationPath.$filename);
	            return $destinationPath.$filename;
			}
			Image::make($destinationPath.$filename)
	            ->resize( 200, 200 )//note width x height		
	            ->text('water',100,100,function($font) {
								    //$font->file('foo/bar.ttf');
								    $font->size(200);
								    $font->color(array(255, 255, 255, 0.5));
								    $font->align('center');
								    $font->valign('top');
								    $font->angle(45);
								})
	            ->save($destinationPath.$filename);    	
		}
		return $destinationPath.$filename;
	}
	
	public function getCoordinateByImageId($image_id){
		$coordinates = DB::table('coordinates')->where('image_id',$image_id)->get();
		return $coordinates;
	}

} 

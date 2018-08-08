<?php 
namespace App\Repositories;

use App\Model\Album;
use App\Repositories\AlbumImageRepository;

class AlbumEloquent implements AlbumRepository{
	private $album;
	private $albumImageRepo;

	public function __construct(Album $album,AlbumImageRepository $albumImageRepo){
		$this->album = $album;
		$this->albumImageRepo = $albumImageRepo;

	}
	public function getAllAlbum($limit = null,$status=null){
		if($limit!=null){
			if($status!=null){
				return $this->album
						->join('users','users.id','=','album.user_id')
						->select(
								'album.*','users.name as created_by'
							)
						->where('status',$status)
						->orderBy('display_order')
						->paginate($limit, ['*'], 'album');
			}
			return $this->album
						->join('users','users.id','=','album.user_id')
						->select(
								'album.*','users.name as created_by'
							)
						->orderBy('display_order')
						->paginate($limit, ['*'], 'album');

		}
		return $this->album->join('users','users.id','=','album.user_id')
							->select(
								'album.*','users.name as created_by'
							)
							->orderBy('album.display_order')
							->get();
	}

	public function getAlbumById($id){
		return $this->album->join('users','users.id','=','album.user_id')
							->select(
								'album.*','users.name as created_by'
							)
							->where('album.id',$id)
							->first();
		//return $this->album->findorfail($id);
	}

	public function createAlbum(array $attributes){
		return $this->album->create($attributes);
	}

	public function updateAlbum($id,array $attributes){
		return $this->album->findorfail($id)->update($attributes);
	}

	public function deleteAlbum($id){
		$images = $this->albumImageRepo->getAlbumImageByAlbumId($id);
		foreach($images as $image){
			$this->albumImageRepo->deleteAlbumImage($image['id']);
		}
		return $this->album->findorfail($id)->delete();
	}

	/*------------------------------------------------------------------------------------
	 this commented code is only for image you can remove it there is not image
	 		------------------------------------------------------------------------------------*/
	/*
	private function uploadImage($file){
		if($file){
			$extension = $file->getClientOriginalExtension();
			$filename= md5(microtime()).'.'.$extension;
			$destinationPath= 'uploads/image/';
			$file->move($destinationPath,$filename);
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
	*/

	//copy this code in create function----
		/*
		if(array_key_exists('image', $attributes)){
			$path = $this->uploadImage($attributes['image']);
			$attributes['image']=$path;
		}
		*/

	//copy this code in update need some edit ----
		/*
		if(array_key_exists('image', $attributes)){
			$testimonial = $this->testimonial->findorfail($id);
			//delete image
			if($testimonial['image']!='' && file_exists($testimonial['image'])){ 				
				unlink($testimonial['image']);
			}
			$path = $this->uploadImage($attributes['image']);
			$attributes['image']=$path;
		}
		*/

	//copy this code in delete function ----
		/*
		$testimonial = $this->testimonial->findorfail($id);
		//delete image 
		if($testimonial['image']!='' && file_exists($testimonial['image'])){
			unlink($testimonial['image']);
		}
		*/

}
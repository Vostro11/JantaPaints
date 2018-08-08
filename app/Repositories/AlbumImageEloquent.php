<?php 
namespace App\Repositories;

use App\Model\AlbumImage;
use Image;
use DB;
class AlbumImageEloquent implements AlbumImageRepository{
	private $albumimage;

	public function __construct(AlbumImage $albumimage){
		$this->albumimage = $albumimage;
	}
	public function getAllAlbumImage($limit = null){
		if($limit!=null){
		return $this->albumimage
					->join('users','users.id','=','album_images.user_id')
					->join('album','album.id','=','album_images.album_id')
					->select(
							'album_images.*','users.name as created_by','album.name as album'
						)
					->orderBy('display_order')
					->paginate($limit);
		}
		return $this->albumimage
					->join('users','users.id','=','album_images.user_id')
					->join('album','album.id','=','album_images.album_id')
					->select(
							'album_images.*','users.name as created_by','album.name as album'
						)
					->orderBy('album_images.display_order')
					->get();
	}

	public function getAlbumImageByAlbumId($album_id,$limit = null){
		if($limit!=null){
		return $this->albumimage
					->join('users','users.id','=','album_images.user_id')
					->join('album','album.id','=','album_images.album_id')
					->select(
							'album_images.*','users.name as created_by','album.name as album'
						)
					->where('album_images.album_id',$album_id)
					->orderBy('album_images.display_order')
					->paginate($limit);
		}
		return $this->albumimage
					->join('users','users.id','=','album_images.user_id')
					->join('album','album.id','=','album_images.album_id')
					->select(
							'album_images.*','users.name as created_by','album.name as album'
						)
					->orderBy('album_images.display_order')
					->where('album_images.album_id',$album_id)
					->get();
	}

	public function getAlbumImageById($id){
		return $this->albumimage
					->join('users','users.id','=','album_images.user_id')
					->join('album','album.id','=','album_images.album_id')
					->select(
							'album_images.*','users.name as created_by','album.name as album'
						)
					->where('album_images.id',$id)
					->first();
		//return $this->albumimage->findorfail($id);
	}

	public function createAlbumImage(array $attributes){
		if(array_key_exists('image', $attributes)){
			$path = $this->uploadImage($attributes['image']);
			$attributes['image']=$path;
		}
		return $this->albumimage->create($attributes);
	}

	public function updateAlbumImage($id,array $attributes){
		if(array_key_exists('image', $attributes)){
			$albumimage = $this->albumimage->findorfail($id);
			//delete image
			if($albumimage['image']!='' && file_exists($albumimage['image'])){ 				
				unlink($albumimage['image']);
			}
			$path = $this->uploadImage($attributes['image']);
			$attributes['image']=$path;
		}
		return $this->albumimage->findorfail($id)->update($attributes);
	}

	public function deleteAlbumImage($id){
		$albumimage = $this->albumimage->findorfail($id);
		//delete image 
		if($albumimage['image']!='' && file_exists($albumimage['image'])){
			unlink($albumimage['image']);
		}
		return $this->albumimage->findorfail($id)->delete();
	}
	private function uploadImage($file){
		if($file){
			$extension = $file->getClientOriginalExtension();
			$filename= md5(microtime()).'.'.$extension;
			$destinationPath= 'uploads/gallery/';
			$file->move($destinationPath,$filename);
			Image::make($destinationPath.$filename)
                ->resize( 800, 800 )//note width x height		
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

	public function makeCover($id){
		$albumImage = $this->albumimage->findorfail($id);
		//remove other cover image of this album
		DB::table('album_images')
		->where('album_id',$albumImage['album_id'])
		->update(['cover'=>'No']);
		//add this image to cover image-----------
		
		return $albumImage->update(['cover'=>'Yes']);
	}

	public function getCoverByAlbumId($album_id){
		return $this->albumimage
					->where('album_id',$album_id)
					->where('cover','Yes')
					->first();
	}

	

}
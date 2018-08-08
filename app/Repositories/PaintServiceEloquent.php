<?php 
namespace App\Repositories;

use App\Model\Color;
use App\Model\Coordinate;
use App\Model\Image;

class PaintServiceEloquent implements PaintServiceRepository{
	protected $color;
	protected $coordinate;
	protected $image;

	public function __construct(Color $color,Coordinate $coordinate,Image $image){
		$this->color = $color;
		$this->coordinate = $coordinate;
		$this->image = $image;
	}
	/*---------------------------------------------------------------
					Color related Function
	---------------------------------------------------------------*/
	public function getAllColor($limit = null){
		if($limit!=null){
			return $this->color->paginate($limit);
		}
		return $this->color->all();
	}

	public function getColorById($id){
		return $this->color->findorfail($id);
	}

	public function createColor(array $attributes){
		return $this->color->insert($attributes);
	}

	public function updateColor($id,array $attributes){
		return $this->color->findorfail($id)->update($attributes);
	}

	public function deleteColor($id){
		return $this->color->findorfail($id)->delete();
	}
	public function deleteAllColor(){
		return $this->color->truncate();
	}

	public function softDeleteColor($id){
		return $this->color->findorfail($id)->update(['status'=>'Deleted']);
	}

	public function getColorByStatus($status,$limit = null){
		if($limit!=null){
			return $this->color->where('status',$status)->paginate($limit);
		}
		return $this->color->where('status',$status)->get();
	}

	/*---------------------------------------------------------------
					Coordinate related Function
	---------------------------------------------------------------*/
	public function getAllCoordinate($limit = null){
		if($limit!=null){
			return $this->coordinate->paginate($limit);
		}
		return $this->coordinate->all();
	}

	public function getCoordinateById($id){
		return $this->coordinate->findorfail($id);
	}

	public function createCoordinate(array $attributes){
		return $this->coordinate->create($attributes);
	}

	public function updateCoordinate($id,array $attributes){
		return $this->coordinate->findorfail($id)->update($attributes);
	}

	public function deleteCoordinate($id){
		return $this->coordinate->findorfail($id)->delete();
	}

	public function softDeleteCoordinate($id){
		return $this->coordinate->findorfail($id)->update(['status'=>'Deleted']);
	}

	public function getCoordinateByStatus($status,$limit = null){
		if($limit!=null){
			return $this->coordinate->where('status',$status)->paginate($limit);
		}
		return $this->coordinate->where('status',$status)->get();
	}

	/*---------------------------------------------------------------
					Image related Function
	---------------------------------------------------------------*/
	public function getAllImage($limit = null){
		if($limit!=null){
			return $this->image->paginate($limit);
		}
		return $this->image->all();
	}

	public function getImageById($id){
		return $this->image->findorfail($id);
	}

	public function createImage(array $attributes){
		return $this->image->create($attributes);
	}

	public function updateImage($id,array $attributes){
		return $this->image->findorfail($id)->update($attributes);
	}

	public function deleteImage($id){
		return $this->image->findorfail($id)->delete();
	}

	public function softDeleteImage($id){
		return $this->image->findorfail($id)->update(['status'=>'Deleted']);
	}

	public function getImageByStatus($status,$limit = null){
		if($limit!=null){
			return $this->image->where('status',$status)->paginate($limit);
		}
		return $this->image->where('status',$status)->get();
	}

}
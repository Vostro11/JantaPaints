<?php 
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Coordinate extends Model{
	protected $table='coordinates';
	protected $fillable=[
				'id',
				'image_id',
				'coordinate',
				'color_id',
				'label',
			];
	protected $hidden=[
	];
}
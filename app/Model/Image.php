<?php 
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Image extends Model{
	protected $table='images';
	protected $fillable=[
				'id',
				'image',
				'status',
				'user_id',
			];
	protected $hidden=[
	];
}
<?php 
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Album extends Model{
	protected $table='album';
	protected $fillable=[
				'id',
				'name',
				'title',
				'display_order',
				'user_id',
				'status',
			];
	protected $hidden=[
	];
}
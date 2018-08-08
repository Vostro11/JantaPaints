<?php 
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AlbumImage extends Model{
	protected $table='album_images';
	protected $fillable=[
				'id',
				'image',
				'caption',
				'cover',
				'album_id',
				'user_id',
				'display_order',
				'status',
			];
	protected $hidden=[
	];
}
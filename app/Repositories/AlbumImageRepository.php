<?php 
namespace App\Repositories;

interface AlbumImageRepository {

	function getAllAlbumImage();

	function getAlbumImageById($id);

	function createAlbumImage(array $attributes);

	function updateAlbumImage($id, array $attributes);

	function deleteAlbumImage($id);

}

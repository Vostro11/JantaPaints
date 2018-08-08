<?php 
namespace App\Repositories;

interface AlbumRepository {

	function getAllAlbum();

	function getAlbumById($id);

	function createAlbum(array $attributes);

	function updateAlbum($id, array $attributes);

	function deleteAlbum($id);

}

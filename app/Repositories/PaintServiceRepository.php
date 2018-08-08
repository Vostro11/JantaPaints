<?php 
namespace App\Repositories;

interface PaintServiceRepository {

	function getAllColor();

	function getColorById($id);

	function createColor(array $attributes);

	function updateColor($id, array $attributes);

	function deleteColor($id);

	function getAllCoordinate();

	function getCoordinateById($id);

	function createCoordinate(array $attributes);

	function updateCoordinate($id, array $attributes);

	function deleteCoordinate($id);

	function getAllImage();

	function getImageById($id);

	function createImage(array $attributes);

	function updateImage($id, array $attributes);

	function deleteImage($id);

}

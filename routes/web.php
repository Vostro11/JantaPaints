<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'VisualiserController@index');

Auth::routes();

/*
|--------------------------------------------------------------------------
| Setup Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'setup'], function() { 
	Route::get('/cache-clear', function(){ 
		\Artisan::call('cache:clear');
		echo 'cache-clear complete';
	});
	Route::get('/config-cache', function(){ 
		\Artisan::call('config:cache');
		echo 'config-cache complete';
	});
	Route::get('/dump-autoload', function(){ 
		exec('composer dump-autoload');
		echo 'composer dump-autoload complete';
	});
}); 
/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
*/ 	
Route::group(['prefix' => 'admin'], function() { 
	Route::get('/dashboard','Dashboard\DashboardController@index'); 
	Route::get('/logout','Dashboard\DashboardController@logout'); 
}); 
/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/ 
Route::get('/{id?}', 'VisualiserController@index')->name('home');

Route::post('/image/store', 'Backend\ImageController@store')->name('image.store');
Route::post('/coordinates/store', 'Backend\CoordinateController@storeMultipleCoordinat')->name('store.coordinates');
Route::get('/image-processing/{id?}','VisualiserController@imageProcessing')->name('image-processing');

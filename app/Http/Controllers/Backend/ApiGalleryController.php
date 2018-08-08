<?php 

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Session;
use DB;

class ApiGalleryController extends Controller{
	

	public function __construct(
		
	){
		
	}
	
	public function getAlbums(){
	    $albums = DB::table('album')->get();
    	//$organization= DB::table('organizations')->where('id',$user['organization_id'])->first();
	    return response()->json($albums,200);
	    
    }

}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\AlbumImageRepository;
use App\Repositories\AlbumRepository;
use App\Repositories\PaintModuleRepository;

use DB;
class VisualiserController extends Controller
{
    private $albumImageRepo;
    private $paintModuleRepo;
    private $albumRepo;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    public function __construct(
        AlbumImageRepository $albumImageRepo,
        AlbumRepository $albumRepo,
        PaintModuleRepository $paintModuleRepo
    ){
        $this->albumImageRepo = $albumImageRepo;
        $this->albumRepo = $albumRepo;
        $this->paintModuleRepo = $paintModuleRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($image_id=null)
    {

        $image = DB::table('images')->where('id',$image_id)->first();
        //$images = $this->albumImageRepo->getAlbumImageByAlbumId(2,$limit = 12);
        //$images = DB::table('album_images')->paginate(12);
        // if($image){
        //     dd($image);
        // }
        $colors = $this->paintModuleRepo->getAllColor($limit = 49)->toArray();
        return view('frontend.visualiser.visualiser',compact('image','colors'));
    }
    public function about()
    {
        return view('frontend.about.about');
    }
    public function gallery($album_id){
        $images = $this->albumImageRepo->getAlbumImageByAlbumId($album_id,$limit = 12);
        return view('frontend.gallery.gallery',compact('images'));
    }

    public function upload()
    {
        return view('frontend.upload.upload');
    }

    public function imageProcessing($image_id=null){
        $colors = $this->paintModuleRepo->getAllColor($limit = 30);
        $image = DB::table('images')->where('id',$image_id)->first();
        $coordinates = $this->paintModuleRepo->getCoordinateByImageId($image->id);
        //$images = $this->albumImageRepo->getAlbumImageByAlbumId(2,$limit = 12);
        //dd($coordinates);
        // $images = DB::table('album_images')->paginate(12);
        // dd($coordinates);
        return view('frontend.visualiser.image_processing',compact('image','colors','coordinates','images'));
    }
}

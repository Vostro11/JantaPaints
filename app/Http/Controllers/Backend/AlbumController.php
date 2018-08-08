<?php 

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Session;
use app\Repositories\AlbumImageRepository;
use app\Repositories\AlbumRepository;

class AlbumController extends Controller{
	private $albumImageRepo;
	private $albumRepo;

	public function __construct(
		AlbumImageRepository $albumImageRepo,
		AlbumRepository $albumRepo
	){
		$this->albumImageRepo = $albumImageRepo;
		$this->albumRepo = $albumRepo;

	}

	/**
	* Display a listing of the resource.
	* @return Response
	*/
	public function index(){
		$albums = $this->albumRepo->getAllAlbum($limit = 10);
		$albumImages = $this->albumImageRepo->getAllAlbumImage($limit = 12);
		if(Session::get('album_id') != null){
			$albumImages = $this->albumImageRepo->getAlbumImageByAlbumId(Session::get('album_id'),$limit = 12);
		}
		
		return view('gallery::album.index',compact('albums','albumImages'));
	}

	/**
	* Show the form for creating a new resource.
	* @return Response
	*/
	public function create(){
		return view('gallery::album.create');
	}

	/**
	* Store a newly created resource in storage.
	* @param  Request $request
	* @return Response
	*/
	public function store(Request $request){
		$this->albumRepo->createAlbum($request->all());
		Session::flash('success','Operation Success');
		return redirect('admin/gallery/album');
	}

	/**
	* Show the specified resource.
	* @return Response
	*/
	public function show($id){
		$album = $this->albumRepo->getAlbumById($id);
		return view('gallery::album.show',compact('album'));
	}

	/**
	* Show the specified resource.
	* @return Response
	*/
	public function edit($id){
		$album = $this->albumRepo->getAlbumById($id);
		return view('gallery::album.edit',compact('album'));
	}

	/**
	* Update the specified resource in storage..
	* Request $request
	* @return Response
	*/
	public function update($id ,Request $request){
		$this->albumRepo->updateAlbum($id,$request->all());
		Session::flash('success','Operation Success');
		return redirect('admin/gallery/album');
	}

	/**
	* Remove the specified resource from storage.
	* @return Response
	*/
	public function delete($id){
		$this->albumRepo->deleteAlbum($id);
		Session::flash('success','Operation Success');
		return redirect('admin/gallery/album');
	}

	public function addAlbumToSession($album_id){

		Session::put('album_id',$album_id);
		
		if($album_id==0){
			Session::put('album_id',null);
		}
		return back();
	}

}
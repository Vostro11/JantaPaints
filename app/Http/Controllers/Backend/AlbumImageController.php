<?php 

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Session;
use app\Repositories\AlbumImageRepository;
use app\Repositories\AlbumRepository;


class AlbumImageController extends Controller{
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
		$albumImages = $this->albumImageRepo->getAllAlbumImage($limit = 10);
		return view('gallery::albumimage.index',compact('albumImages'));
	}

	/**
	* Show the form for creating a new resource.
	* @return Response
	*/
	public function create(){
		$albums = $this->albumRepo->getAllAlbum();
		return view('gallery::albumimage.create',compact('albums'));
	}

	/**
	* Store a newly created resource in storage.
	* @param  Request $request
	* @return Response
	*/
	public function store(Request $request){
		$this->albumImageRepo->createAlbumImage($request->all());
		Session::flash('success','Operation Success');
		return redirect('admin/gallery/album');
	}

	/**
	* Show the specified resource.
	* @return Response
	*/
	public function show($id){
		$albumImage = $this->albumImageRepo->getAlbumImageById($id);
		return view('gallery::albumimage.show',compact('albumImage'));
	}

	/**
	* Show the specified resource.
	* @return Response
	*/
	public function edit($id){
		$albums = $this->albumRepo->getAllAlbum();
		$albumImage = $this->albumImageRepo->getAlbumImageById($id);
		return view('gallery::albumimage.edit',compact('albumImage','albums'));
	}

	/**
	* Update the specified resource in storage..
	* Request $request
	* @return Response
	*/
	public function update($id ,Request $request){
		$this->albumImageRepo->updateAlbumImage($id,$request->all());
		Session::flash('success','Operation Success');
		return redirect('admin/gallery/album');
	}

	/**
	* Remove the specified resource from storage.
	* @return Response
	*/
	public function delete($id){
		$this->albumImageRepo->deleteAlbumImage($id);
		Session::flash('success','Operation Success');
		//return redirect('admin/gallery/album');
		return back();
	}

	public function makeCover($id){
		$this->albumImageRepo->makeCover($id);
		return back();
	}

}
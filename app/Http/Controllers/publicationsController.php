<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\publicationRequest;

use App\Http\Controllers\Controller;
use App\Publication;
use App\Image;
use App\Category;
use App\Estado;
use Illuminate\Support\Facades\Auth;
class publicationsController extends Controller
{

    /**
	* @return \Illuminate\Http\Response
	*/
	public function index()
	{
		return view("admin.publications.index");
	}
	
	public function listado($category=null,$word=null)
	{
		$categories=Category::all();
		$estados=Estado::all();
		$publications=Publication::orderBy('id','DESC')->paginate(15);
		return view('site.listado')->with("categories",$categories)
								   ->with("estados",$estados)
								   ->with("publications",$publications);
	}
	/*
	* @return \Illuminate\Http\Response
	*/
	public function create(){
		$categories=Category::all()->lists('name','id');
		return view('site.publications.create')->with('categories',$categories);
	}

	/**
	* @param \Illuminate\Http\Request $request
	* @return \Illuminate\Http\Response
	*/
	public function store(publicationRequest $request){
		$publication=new Publication($request->all());
		$publication->user_id=Auth::user()->id;
		$publication->save();
		$images=explode("CUSTOM-SEPARATOR-IVAN",$request->imagenes);
		$c=0;$route="img/publications/";
		foreach($images as $image){
			//Obtener la dataurl de la imagen
			$data_url = str_replace(" ", "+", $image);
			$filteredData=substr($data_url, strpos($data_url, ",")+1);
			//Decodificar la dataurl
			$unencodedData=base64_decode($filteredData);
			//subir la imagen
			$name=time();
			$route = "{$route}{$name}.png";
			if(file_put_contents($route, $unencodedData)){
				//
				$imagen=new Image();
				$imagen->name=$name;
				$imagen->extention="png";
				$imagen->route=$route;
				$imagen->publication_id=$publication->id;
				$imagen->position=$c;
				$imagen->save();
				$c++;				
			}
		}	
		return redirect()->route('publications.show',$publication->id);
	}

	/**
	* @param int $id
	* @return \Illuminate\Http\Response
	*/
	public function show($id){
		$publication=Publication::find($id);
		return view('site.publications.view')->with("publication",$publication);
	}

	/*
	* @param int $id
	* @return \Illuminate\Http\Response
	*/
	public function edit($id){

	}

	/*
	* @param \Illuminate\Http\Request $request
	* @param int $id
	* @return \Illuminate\Http\Response
	*/
	public function update(Request $request, $id){

	}

	/*
	* @param int $id
	* @return \Illuminate\Http\Response
	*/
	public function destroy($id){

	}
	
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use App\Category;


class categoriesController extends Controller
{

    /**
	* @return \Illuminate\Http\Response
	*/
	public function index()
	{
		$categories=Category::orderBy("id","ASC")->paginate(2);
		return view("admin.categories.index")->with("categories",$categories);
	}

	/*
	* @return \Illuminate\Http\Response
	*/
	public function create(){
		return view('admin.categories.create');
	}

	/**
	* @param \Illuminate\Http\Request $request
	* @return \Illuminate\Http\Response
	*/
	public function store(Request $request){
		dd($request);
	}

	/**
	* @param int $id
	* @return \Illuminate\Http\Response
	*/
	public function show($id){

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
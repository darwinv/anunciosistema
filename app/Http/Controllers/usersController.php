<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UserRequest;

use App\Http\Controllers\Controller;
use App\User;
use App\Estado;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
class usersController extends Controller
{

    /**
	* @return \Illuminate\Http\Response
	*/
	public function index()
	{
		return view("welcome");
	}

	/*
	* @return \Illuminate\Http\Response
	*/
	public function create(){
		return view('site.users.create');
	}

	/**
	* @param \Illuminate\Http\Request $request
	* @return \Illuminate\Http\Response
	*/
	public function store(Request $request){
		dd('Ok');
	}

	/**
	* @param int $id
	* @return \Illuminate\Http\Response
	*/
	public function show($id){
		$estados=Estado::all()->lists('name','id');
		return view('site.users.profile',['user' => User::findOrFail($id), 'estados' => $estados]);
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
		$user=User::find($id);
		$user->fill($request->all());
		$user->save();
		Flash::success("Tu Perfil ha sido actualizado con exito!!!");
		return redirect()->route('users.show',Auth::user()->id);
	}

	/*
	* @param int $id
	* @return \Illuminate\Http\Response
	*/
	public function destroy($id){

	}
	
	public function postRegister(UserRequest $request){
		$user=new User($request->all());
		$user->password=bcrypt($user->password);
		if($user->save())
			return redirect()->route('siteHome');
	}	

	public function getLogout(){		
		Auth::logout();
		return redirect()->route('siteHome');
	}
}
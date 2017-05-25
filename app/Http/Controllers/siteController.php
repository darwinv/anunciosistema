<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Laracasts\Flash\Flash;
use App\Category;
use App\Publication;
use App\Estado;
class siteController extends Controller
{
    public function home()
    {
		$categories=Category::all();
		$publications=Publication::orderBy('id','DESC')->paginate(3);
		foreach($publications as $publication){
			$publication->category();
			$publication->images();
			$publication->user();
			$publication->user->estado();
		}
//		dd($publications);
    	return view("welcome")->with("categories",$categories)
							  ->with("publications",$publications);
    }

    public function login()
    {
    	return view("admin/welcome");
    }

    public function panel()
    {
        return view("admin/panel");
    }

    public function configuration()
    {
        return view("admin/configuration");
    }
}

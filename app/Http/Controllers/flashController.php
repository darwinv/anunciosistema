<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class flashController extends Controller
{
    //
    public function index(){
	{!! flash('IVANNNN', 'info') !!}        
    }

}

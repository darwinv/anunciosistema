<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table="categories";

    protected $fillable=['name','status'];
	
	public function publications(){
		return $this->hasMany('App\Publication');
	}
}
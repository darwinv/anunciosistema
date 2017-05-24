<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departament extends Model
{
    //
	protected $table="departaments";
	
	protected $fillable=[
		'name'
	];
	
	public function users(){
		return $this->hasMany('App\User');
	}
	
	public function tests(){
		return $this->hasMany('App\Test');
	}
}

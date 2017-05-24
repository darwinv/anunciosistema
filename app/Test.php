<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    //
	protected $table="tests";
	
	protected $fillable=[
		"name"
	];
	
	public function users(){
		return $this->hasMany('App\User');
	}
	
	public function departament(){
		return $this->belongsTo('App\Departament');
	}
}
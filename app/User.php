<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'seudonimo', 'email', 'password', 'role', 'type', 'sex', 'dateofbith', 'estado_id','phones','physipshop','bill','description',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
	
	public function getPicture(){
		$default="default.jpg";
		if(file_exists('../public/img/users/' . $this->id . '.jpg')){
			return $this->id . '.jpg';
		}else{
			return $default;	
		}		
	}
	
	public function publications(){
		return $this->hasMany('App\Publication');
	}
	
	public function estado(){
		return $this->belongsTo('App\Estado');
	}
	
	public function getFullName(){
		return $this->name . " " . $this->surname;
	}
		
}
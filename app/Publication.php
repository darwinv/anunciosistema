<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'price', 'garantia', 'condition_id','category_id','user_id','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];
	
	public function category(){
		return $this->belongsTo('App\Category');
	}
	
	public function images(){
		return $this->hasMany('App\Image');
	}
	
	public function user(){
		return $this->belongsTo('App\User');
	}
	
	public function getCondition(){
		$conditions=[0=>"Nuevo",1=>"Usado",2=>"Servicio",3=>"Mascota"];
		return $conditions[$this->condition_id];
	}
	
	public function getViews(){
		return 15;
	}
	
	public function getLikes(){
		return 21;
	}
}

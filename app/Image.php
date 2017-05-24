<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
	protected $table="images";
	
    protected $fillable=[
			"name","extention","route","publication_id","position","status"
	];
	
	public function publication(){
		return $this->belongsTo('App\Publication');
	}
}
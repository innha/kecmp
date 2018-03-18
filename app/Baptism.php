<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Baptism extends Model
{
    protected $fillable = ['teaching_id', 'date_baptized', 'user_id'];

    public function teaching()
    {
    	return $this->belongsTo('App\Teaching');
    }   
}

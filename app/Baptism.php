<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Baptism extends Model
{
    protected $fillable = ['registration_id', 'date_baptized', 'user_id'];

    public function registration()
    {
    	return $this->belongsTo('App\Registration');
    }    
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choir extends Model
{
    protected $fillable = ['name', 'equipment'];

    public function registrations()
    {
    	return $this->hasMany('App\Registration');
    }

    public function singer()
    {
    	return $this->belongsTo('App\Choir');
    }  
}

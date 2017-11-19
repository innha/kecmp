<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapelle extends Model
{
    protected $fillable = ['parish_id', 'code', 'name'];

    public function zones()
    {
    	return $this->hasMany('App\Zone');
    }

    public function parish()
    {
    	return $this->belongsTo('App\Parish');
    }

    public function users()
    {
    	return $this->hasMany('App\User');
    }

    public function registrations()
    {
        return $this->hasMany('App\Registration');
    }      
}

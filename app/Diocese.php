<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diocese extends Model
{
    protected $fillable = ['name'];

    public function parishes()
    {
    	return $this->hasMany('App\Parish');
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

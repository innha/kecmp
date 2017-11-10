<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = ['name', 'code'];

    public function districts()
    {
    	return $this->hasMany('App\District');
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

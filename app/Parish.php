<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parish extends Model
{
    protected $fillable = ['diocese_id', 'code', 'name'];

    public function chapelles()
    {
    	return $this->hasMany('App\Chapelles');
    }

    public function diocese()
    {
    	return $this->belongsTo('App\Diocese');
    }

    public function district()
    {
        return $this->belongsTo('App\District');
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

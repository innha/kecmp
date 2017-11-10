<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    protected $fillable = ['district_id', 'code', 'name'];

    public function cells()
    {
    	return $this->hasMany('App\Cell');
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

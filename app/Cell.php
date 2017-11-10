<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cell extends Model
{
    protected $fillable = ['sector_id', 'code', 'name'];

    public function villages()
    {
    	return $this->hasMany('App\Village');
    }

    public function sector()
    {
    	return $this->belongsTo('App\Sector');
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

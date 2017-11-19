<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $fillable = ['chapelle_id', 'code', 'name'];

    public function chapelle()
    {
    	return $this->belongsTo('App\Chapelle');
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

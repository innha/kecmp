<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Singer extends Model
{
    protected $fillable = ['registration_id', 'choir_id', 'role', 'user_id'];

    public function registration()
    {
    	return $this->belongsTo('App\Registration');
    }

    public function choirs()
    {
    	return $this->hasMany('App\Choir');
    }
}

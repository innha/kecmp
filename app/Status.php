<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['name'];

    public function registrations()
    {
        return $this->hasMany('App\Registration');
    }

    public function users()
    {
        return $this->hasMany('App\User');
    	// return $this->belongsToMany('App\User', 'user_status')->withTimestamps()->using('App\UserStatus');
    }
}

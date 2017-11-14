<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['name'];

    public function members()
    {
    	// return $this->hasMany('App\Registration');
    	return $this->belongsToMany('App\Member', 'member_status')->withTimestamps()->using('App\MemberStatus');
        // return $this->hasMany('App\Member');
    }

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

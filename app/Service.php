<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name'];

    public function members()
    {
    	// return $this->hasMany('App\Member');
    	return $this->belongsToMany('App\Member', 'member_service')->withTimestamps()->using('App\MemberService');
    }

    public function registrations()
    {
        return $this->hasMany('App\Registration');
    }     
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Duty extends Model
{
    protected $fillable = ['name'];

    public function members()
    {
    	// return $this->hasMany('App\Registration');
    	return $this->belongsToMany('App\Member', 'member_duty')->withTimestamps()->using('App\MemberDuty');
    	// return $this->hasMany('App\Member');
    }

    public function registrations()
    {
        return $this->hasMany('App\Registration');
    }        
}

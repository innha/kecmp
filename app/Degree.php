<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    protected $fillable = ['name'];

    public function members()
    {
    	// return $this->hasMany('App\Registration');
    	// return $this->belongsToMany('App\Member', 'member_degree')->withTimestamps()->using('MemberDegree');
    	return $this->hasMany('App\Member');
    }

    public function registrations()
    {
        return $this->hasMany('App\Registration');
    }    
}

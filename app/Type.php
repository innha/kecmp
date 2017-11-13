<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = ['name'];

    public function members()
    {
    	// return $this->hasMany('App\Registration');
    	// return $this->belongsToMany('App\Member', 'member_type')->withTimestamps()->using('App\MemberType');
    	return $this->hasMany('App\Member');
    }
}

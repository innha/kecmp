<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    public function members()
    {
    	// return $this->hasMany('App\Registration');
    	// return $this->belongsToMany('App\Member', 'member_category')->withTimestamps()->using('App\MemberCategory');
    	return $this->hasMany('App\Member');
    }    
}

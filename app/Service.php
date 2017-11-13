<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name'];

    public function members()
    {
    	return $this->hasMany('App\Member', 'member_service')->withTimestamps()->using('App\MemberService');
    }    
}

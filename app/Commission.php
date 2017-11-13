<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    protected $fillable = ['name'];

    public function members()
    {
    	// return $this->hasMany('App\Member', 'member_commission')->withTimestamps()->using('App\MemberCommission');
    	return $this->hasMany('App\Commission');
    }    
}

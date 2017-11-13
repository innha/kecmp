<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name'];

    public function users()
    {
    	// return $this->hasMany('App\User');
    	return $this->belongsToMany('App\User', 'user_role')->withTimestamps()->using('App\UserRole');
    }
}

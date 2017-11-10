<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = ['province_id', 'code', 'name'];

    public function sectors()
    {
    	return $this->hasMany('App\Sector');
    }

    public function province()
    {
    	return $this->belongsTo('App\Province');
    }

    public function users()
    {
    	return $this->hasMany('App\User');
    }

    public function registrations()
    {
        return $this->hasMany('App\Registration');
    }       
}

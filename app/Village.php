<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    protected $fillable = ['cell_id', 'code', 'name'];

    public function cell()
    {
    	return $this->belongsTo('App\Cell');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function registrations()
    {
    	return $this->hasMany('App\Registration');
    }        
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repenting extends Model
{
    protected $fillable = ['registration_id', 'date_returned', 'reinstator', 'user_id'];

    public function suspension()
    {
    	return $this->belongsTo('App\Suspension');
    }
}

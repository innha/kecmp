<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suspension extends Model
{
    protected $fillable = ['registration_id', 'reason', 'suspendor', 'date_suspended', 'user_id'];

    public function registration()
    {
    	return $this->belongsTo('App\Registration');
    }
}

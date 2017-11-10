<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suspension extends Model
{
    protected $fillable = ['registration_id', 'reason', 'authRegNum', 'user_id'];

    public function registration()
    {
    	return $this->belongsTo('App\Registration');
    }
}

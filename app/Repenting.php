<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repenting extends Model
{
    protected $fillable = ['registration_id', 'date_returned', 'authRegNum', 'user_id'];

    public function registration()
    {
    	return $this->belongsTo('App\Registration');
    }
}

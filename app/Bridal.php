<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bridal extends Model
{
    protected $fillable = ['registration_id', 'bridalName', 'origin', 'user_id'];

    public function registration()
    {
    	return $this->belongsTo('App\Registration');
    }
}

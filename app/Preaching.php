<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preaching extends Model
{
    protected $fillable = ['registration_id', 'topic', 'date_preached', 'hasRepented', 'user_id'];

    public function registration()
    {
    	return $this->belongsTo('App\Registration');
    }
}

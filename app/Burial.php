<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Burial extends Model
{
    protected $fillable = ['registration_id', 'date_died', 'date_buried', 'burialPlace', 'user_id'];

    public function registration()
    {
    	return $this->belongsTo('App\Registration');
    }
}

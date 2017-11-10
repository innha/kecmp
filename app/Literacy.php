<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Literacy extends Model
{
    protected $fillable = ['registration_id', 'period', 'user_id'];

    public function registration()
    {
    	return $this->belongsTo('App\Registration');
    }
}

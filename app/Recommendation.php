<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    protected $fillable = ['registration_id', 'origin_parish', 'date_issued', 'destination_parish', 'date_arrived', 'user_id'];

    public function registration()
    {
    	return $this->belongsTo('App\Registration');
    }
}

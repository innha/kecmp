<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    protected $fillable = ['registration_id', 'date_issued', 'ownerName', 'destination', 'holderName', 'date_arrived', 'user_id'];

    public function registration()
    {
    	return $this->belongsTo('App\Registration');
    }
}

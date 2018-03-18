<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kid extends Model
{
    protected $fillable = ['child_names', 'registration_id', 'date_prayed', 'user_id'];

    public function registration()
    {
    	return $this->belongsTo('App\Registration');
    }
}

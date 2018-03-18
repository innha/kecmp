<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preaching extends Model
{
    protected $fillable = ['visitor_names', 'topic', 'date_preached', 'num_repented', 'user_id'];
    /*
    public function registration()
    {
    	return $this->belongsTo('App\Registration');
    }
    */
}

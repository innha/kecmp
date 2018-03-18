<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teaching extends Model
{
    protected $fillable = ['registration_id', 'cell_id', 'parish_id', 'date_started', 'date_ended', 'user_id'];

    public function registration()
    {
    	return $this->belongsTo('App\Registration');
    }    
}

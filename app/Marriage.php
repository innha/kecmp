<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marriage extends Model
{
    protected $fillable = ['registration_id', 'bridal_id', 'date_married', 'marriagePlace', 'user_id'];

    public function registration()
    {
    	return $this->belongsTo('App\Registration');
    }    
}

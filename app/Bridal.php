<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bridal extends Model
{
    protected $fillable = ['m_bridal_id', 'f_bridal_id', 'origin', 'user_id'];

    public function registration()
    {
    	return $this->belongsTo('App\Registration');
    }
}

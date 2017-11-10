<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reception extends Model
{
    protected $fillable = ['registration_id', 'cell_id', 'parish_id', 'user_id'];

    public function registration()
    {
    	return $this->belongsTo('App\Registration');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['file'];

    protected $uploads = '/images/users/';

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    //accessor
    public function getFileAttribute($photo)
    {
    	return $this->uploads . $photo;
    }
}

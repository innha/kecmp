<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegStatus extends Model
{
    protected $fillable = ['registration_id', 'status_id', 'date_started', 'date_ended', 'user_id'];
}

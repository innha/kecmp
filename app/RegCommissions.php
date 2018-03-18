<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegCommissions extends Model
{
    protected $fillable = ['registration_id', 'commission_id', 'date_started', 'date_ended', 'user_id'];
}

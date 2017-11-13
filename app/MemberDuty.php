<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberDuty extends Model
{
    protected $fillable = ['member_id', 'duty_id', 'user_id'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberService extends Model
{
    protected $fillable = ['member_id', 'service_id', 'user_id'];
}

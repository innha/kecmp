<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberCommission extends Model
{
    protected $fillable = ['member_id', 'commission_id', 'user_id'];
}

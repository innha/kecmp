<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberType extends Model
{
    protected $fillable = ['member_id', 'type_id', 'user_id'];
}

<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class MemberDegree extends Pivot
{
    protected $fillable = ['member_id', 'degree_id', 'school', 'user_id'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberCategory extends Model
{
    protected $fillable = ['member_id', 'category_id', 'user_id'];
}

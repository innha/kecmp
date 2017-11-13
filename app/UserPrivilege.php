<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPrivilege extends Model
{
    protected $fillable = ['user_id', 'privilege_id'];
}

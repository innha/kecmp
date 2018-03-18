<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegTasks extends Model
{
    protected $fillable = ['registration_id', 'task_id', 'date_started', 'date_ended', 'user_id'];
}

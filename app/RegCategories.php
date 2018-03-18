<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegCategories extends Model
{
    protected $fillable = ['registration_id', 'category_id', 'date_started', 'date_ended', 'user_id'];
}

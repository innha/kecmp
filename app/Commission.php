<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    protected $fillable = ['name'];

    public function commission_reports()
    {
        return $this->hasMany('App\CommissionReport');
    }      
}

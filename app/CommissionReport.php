<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommissionReport extends Model
{
    protected $fillable = ['commission_id', 'report', 'report_date', 'comment', 'user_id'];

    public function commission()
    {
    	return $this->belongsTo('App\Commission');
    }    
}

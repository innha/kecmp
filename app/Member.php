<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    
    protected $fillable = [

    	'type_id',
    	'degree_id',
    	'duty_id',
    	'category_id',
    	'service_id',
    	'commission_id',
    	'status_id',

    ];

    public function types()
    {
    	return $this->belongsToMany('App\Type', 'member_type')->withTimestamps()->using('App\MemberType');
        // return $this->belongsTo('App\Type');
    }

    public function categories()
    {
    	return $this->belongsToMany('App\Category', 'member_category')->withTimestamps()->using('App\MemberCategory');
        // return $this->belongsTo('App\Category');
    }

    public function degrees()
    {
    	return $this->belongsToMany('App\Degree', 'member_degree')->withTimestamps()->using('App\MemberDegree');
        // return $this->belongsTo('App\Degree');
    }

    public function duties()
    {
    	return $this->belongsToMany('App\Duty', 'member_duty')->withTimestamps()->using('App\MemberDuty');
        // return $this->belongsTo('App\Duty');
    }

    public function commissions()
    {
    	return $this->belongsToMany('App\Commission', 'member_commission')->withTimestamps()->using('App\MemberCommission');
        // return $this->belongsTo('App\Commission');
    }   

    public function services()
    {
        return $this->belongsToMany('App\Service', 'member_service')->withTimestamps()->using('App\MemberService');
        // return $this->belongsTo('App\Service');
    }

    public function statuses()
    {
        return $this->belongsToMany('App\Status', 'member_status')->withTimestamps()->using('App\MemberStatus');
        // return $this->belongsTo('App\Status');
    }   

    public function registration()
    {
    	return $this->belongsTo('App\Registration');
    }
}

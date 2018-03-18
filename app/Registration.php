<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Registration extends Model
{    

    /*
        'fLastName',
        'fFirstName',
        'mLastName',
        'mFirstName',
    */
    protected $fillable = [
        // 'type_id',
        'degree_id',
        'category_id',
        'task_id',
        // 'service_id',
        'commission_id',
        // 'duty_id',
        'status_id',        
    	'regNumber',
    	'lastName',
    	'firstName',
        'fLastName',
        'fFirstName',
        'mLastName',
        'mFirstName',
    	'dob',
    	'birthPlace',
    	'phoneOne',
    	'phoneTwo',
    	'gender',
    	// 'idNumber', 	
    	'maritalStatus',
        'legallyMarried',
    	'email',
    	'village_id',
    	'cell_id',
    	'sector_id',
    	'district_id',
    	'province_id',
    	'zone_id',
    	'chapelle_id',
    	'parish_id',
    	'diocese_id',
    	'ownsHouse',
    	'job_id',
    	// 'employer',
    	// 'jobLocation',
    	'baptismDate',
    	'baptismParish',    	    	    	    	
    	'choir_id',
        'origin_cell',
        'origin_parish',
    	'user_id',    	
    	'confirmed',
    	'notes',    	
    ];

    private $format = 'Y-m-d';

    public function setDobAttribute($value)
    {
        $this->attributes['dob'] = Carbon::parse($value)->format($this->format);
    }   

    public function setBaptismDateAttribute($value)
    {
        $this->attributes['baptismDate'] = Carbon::parse($value)->format($this->format);
    }
    /*
    public function type()
    {
        return $this->belongsTo('App\Type');
    }
    */
    public function task()
    {
        return $this->belongsTo('App\Task');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function degree()
    {
        return $this->belongsTo('App\Degree');
    }

    public function duty()
    {
        return $this->belongsTo('App\Duty');
    }

    public function commission()
    {
        return $this->belongsTo('App\Commission');
    }   

    public function service()
    {
        return $this->belongsTo('App\Service');
    }

    public function job()
    {
        return $this->belongsTo('App\Job');
    }    

    public function status()
    {
        return $this->belongsTo('App\Status');
    }    

    public function village()
    {
    	return $this->belongsTo('App\Village');
    }     

    public function cell()
    {
    	return $this->belongsTo('App\Cell');
    }    

    public function sector()
    {
    	return $this->belongsTo('App\Sector');
    }

    public function district()
    {
    	return $this->belongsTo('App\District');
    }

    public function province()
    {
    	return $this->belongsTo('App\Province');
    }

    public function zone()
    {
    	return $this->belongsTo('App\Zone');
    }    

    public function chapelle()
    {
    	return $this->belongsTo('App\Chapelle');
    }

    public function parish()
    {
    	return $this->belongsTo('App\Parish');
    }

    public function diocese()
    {
    	return $this->belongsTo('App\Diocese');
    }

    public function choir()
    {
        return $this->belongsTo('App\Choir');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function baptisms()
    {
        return $this->hasMany('App\Baptism');
    }

    public function bridals()
    {
        return $this->hasMany('App\Bridal');
    }

    public function burials()
    {
        return $this->hasMany('App\Burial');
    }

    public function kids()
    {
        return $this->hasMany('App\Kid');
    }

    public function literacies()
    {
        return $this->hasMany('App\Literacy');
    }

    public function marriages()
    {
        return $this->hasMany('App\Marriage');
    }    
    /*
    public function preachings()
    {
        return $this->hasMany('App\Preaching');
    }
    */
    public function receptions()
    {
        return $this->hasMany('App\Reception');
    }

    public function repentings()
    {
        return $this->hasMany('App\Repenting');
    }

    public function suspensions()
    {
        return $this->hasMany('App\Suspension');
    }    

    public function teachings()
    {
        return $this->hasMany('App\Teaching');
    }

    public function singers()
    {
        return $this->hasMany('App\Singer');
    }

    /*
    public function member()
    {
        return $this->hasOne('App\Member');
    }
    */
}

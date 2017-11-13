<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 'privilege_id', 'photo_id', 'is_active', 'name', 'email', 'phone', 'password', 'province_id', 'district_id', 'sector_id', 'cell_id', 'village_id', 'diocese_id', 'parish_id', 'chapelle_id', 'zone_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        // return $this->belongsToMany('App\Role', 'user_role')->withTimestamps()->using('App\UserRole');
        return $this->belongsTo('App\Role');
    }

    public function privilege()
    {
        // return $this->belongsToMany('App\Privilege', 'user_privilege')->withTimestamps()->using('App\UserPrivilege');
        return $this->belongsTo('App\Privilege');
    }

    public function status()
    {
        // return $this->belongsToMany('App\Status', 'user_status')->withTimestamps()->using('App\UserStatus');
        return $this->belongsTo('App\Status');
    }

    public function photo()
    {
        return $this->belongsTo('App\Photo');
    }

    public function province()
    {
        return $this->belongsTo('App\Province');
    }

    public function district()
    {
        return $this->belongsTo('App\District');
    }

    public function sector()
    {
        return $this->belongsTo('App\Sector');
    }

    public function cell()
    {
        return $this->belongsTo('App\Cell');
    }

    public function village()
    {
        return $this->belongsTo('App\Village');
    }

    public function diocese()
    {
        return $this->belongsTo('App\Diocese');
    }

    public function parish()
    {
        return $this->belongsTo('App\Parish');
    }

    public function chapelle()
    {
        return $this->belongsTo('App\Chapelle');
    }

    public function zone()
    {
        return $this->belongsTo('App\Zone');
    }                                    

    public function registrations()
    {
        return $this->hasMany('App\Registration');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('name', 'api_token','phone', 'email','password','blood_type_id', 'd_o_b', 'last_donation_date', 'city_id','pin_code');
    protected $hidden=['password','api_token'];
    public function bloodType()
    {
        return $this->belongsTo('App\Models\BloodType');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function post()
    {
        return $this->belongsToMany('App\Models\Post');
    }

    public function notification()
    {
        return $this->belongsToMany('App\Models\Notification');
    }

    public function governorate()
    {
        return $this->belongsToMany('App\Models\Governorate');
    }

}

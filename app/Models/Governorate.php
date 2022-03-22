<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{

    protected $table = 'governorates';
    public $timestamps = true;
    protected $fillable = array('name');
    protected $hidden=['created_at','updated_at'];

    public function cities()
    {
        return $this->hasMany('App\Models\City');
    }

    public function client()
    {
        return $this->belongsToMany('App\Models\Client');
    }

}

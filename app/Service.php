<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'service';
    protected $guarded = [];

    public function location_name()
    {
        return $this->hasOne('App\Models\LocationModel','id','location_id');
    }

    public function user_details()
    {
        return $this->hasOne('App\User','id','user_id');
    }
}

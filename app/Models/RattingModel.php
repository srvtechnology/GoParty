<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RattingModel extends Model
{
    
      protected $table = 'ratting';
    protected $guarded = [];

    public function getFromUserDetails(){
        return $this->hasOne('App\User', 'id', 'from_id');
    }

     public function getToUserDetails(){
        return $this->hasOne('App\User', 'id', 'to_id');
    }
}

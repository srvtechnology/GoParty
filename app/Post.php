<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'post';
    protected $guarded = [];

    public function user_details()
    {
        return $this->hasOne('App\User','id','user_id');
    }
}

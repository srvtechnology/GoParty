<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentModel extends Model
{
    protected $table = 'payment';

    public function getPayUserDetails(){
        return $this->hasOne('App\User', 'id', 'customer_id');
    }
    
}

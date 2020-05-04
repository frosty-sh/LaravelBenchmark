<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'Customers';

    public function Contact(){
        return $this->hasOne('App\Contact', 'CustomerId' , 'Id');
    }
}
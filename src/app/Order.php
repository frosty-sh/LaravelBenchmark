<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'Orders';

    public function Customer()
    {
        return $this->hasOne('App\Customer', 'Id', 'CustomerID');
    }

    public function OrderItems()
    {
        return $this->hasMany('App\OrderItem', 'OrderId', 'Id');
    }
}
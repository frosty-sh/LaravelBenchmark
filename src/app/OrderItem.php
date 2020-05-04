<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model{
    protected $table = 'OrderItems';

    public function Product(){
        return $this->hasOne('App\Product' , 'Id' , 'ProductId');
    }
}
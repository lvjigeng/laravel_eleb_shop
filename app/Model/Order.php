<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    public function ordersGoods(){

        return $this->hasMany(OrdersGoods::class);
    }
}

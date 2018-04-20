<?php

namespace App\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class ShopAccount extends Authenticatable
{

    protected $fillable=[
      'name','password','status','shop_detail_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

}

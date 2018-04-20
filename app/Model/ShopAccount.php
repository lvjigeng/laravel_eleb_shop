<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ShopAccount extends Model
{

    protected $fillable=[
      'name','password','status'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

}

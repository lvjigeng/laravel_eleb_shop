<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FoodCategory extends Model
{
    //
    protected $fillable=[
      'name','description','shop_detail_id','is_selected'
    ];
}

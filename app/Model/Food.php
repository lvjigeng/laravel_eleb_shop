<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    //
    protected $fillable=[
        'name','food_category_id','price','tips','food_img','shop_detail_id'
    ];

    public function foodCategory()
    {
        return $this->belongsTo(FoodCategory::class,'food_category_id');
    }
}

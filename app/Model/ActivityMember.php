<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ActivityMember extends Model
{
    //
    protected $fillable=[
      'activity_id','shopAccount_id',
    ];
}

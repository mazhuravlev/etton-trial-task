<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    public $incrementing = false;

    function user()
    {
        return $this->belongsTo(User::class);
    }

    function orderItems()
    {

    }

}

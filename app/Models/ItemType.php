<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemType extends Model
{
    public $timestamps = false;
    public $fillable = ['title'];

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}

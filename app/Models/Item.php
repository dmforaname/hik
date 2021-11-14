<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'menu_id',
        'order_id',
        'qty',
        'notes',
    ];
}

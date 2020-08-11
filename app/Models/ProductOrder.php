<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    //
    protected $table = 'product_order';
    protected $fillable = [
        'product_id',
        'order_id',
        'quantity'
    ];
}

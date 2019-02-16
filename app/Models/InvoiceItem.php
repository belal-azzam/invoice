<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends BaseModel
{
    //
    protected $fillable = [
        'product_id',
        'quantity',
        'price',
        'subtotal',
        'total'
    ];
}

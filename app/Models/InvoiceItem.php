<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends BaseModel
{
    //
    protected $fillable = [
        'product_id',
        'invoice_id',
        'item_price',
        'item_total',
        'quantity',
    ];

    function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    function invoice(){
        return $this->belongsTo('App\Models\Invoice');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends BaseModel
{
    //
    protected $fillable = [
        'date',
        'client_id',
        'total',
        'paid',
        'unpaid',
        'status',
        'type',
    ];

    public function invoiceItems()
    {
        return $this->hasMany('App\Models\InvoiceItem');
    }

    public function client(){
        return $this->belongsTo('App\Models\Client');
    }


}

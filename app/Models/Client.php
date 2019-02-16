<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends BaseModel
{
    //
    public function invoices()
    {
        return $this->hasMany('App\Models\Invoice');
    }
}

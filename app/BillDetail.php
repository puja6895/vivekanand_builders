<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    //
    protected $primaryKey = 'bill_id';

    public function customer() {

        return $this->belongsTo('App\Customer','customer_id');
    }
}

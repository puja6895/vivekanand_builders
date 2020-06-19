<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $table = 'sell_payAmounts';
    protected $primarykey = 'pay_amount_id';

    public function customer() {
		return $this->belongsTo('App\Customer','customer_id','customer_id');
  }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchasePayment extends Model
{
    //
    protected $table = 'purchase_payments';
    protected $primarykey = 'purchase_payment_id';

    public function purchaser() {
		return $this->belongsTo('App\Purchaser','purchaser_id','purchaser_id');
  }
}

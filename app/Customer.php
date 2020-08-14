<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    // protected $table = 'customer';
    protected $primaryKey = 'customer_id';

    public function sells() {
		return $this->hasMany('App\Sell','customer_id');
  }

  public function previous_due() {
		return $this->hasMany('App\PreviousDue','customer_id');
  }

  public function bill_detail() {
		return $this->hasMany('App\BillDetail','bill_id','bill_id');
  }
                                          
}

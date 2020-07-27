<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    //
    public function customers() {
		return $this->belongsTo('App\Customer','customer_id','customer_id');
  }
  
  
}

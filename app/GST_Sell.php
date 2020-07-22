<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GST_Sell extends Model
{
    //
    protected $table = 'gstSells';
    protected $primarykey = 'gstSell_id';

  //   public function customer() {
	// 	return $this->belongsTo('App\Customer','customer_id','customer_id');
  // }
  
  // public function gst_sell_products() {
	// 	return $this->hasMany('App\GST_SellProduct','gst_sell_id');
	// }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GstSell extends Model
{
    //
    protected $table = 'gst_sells';
    protected $primarykey = 'id';

    public function customer() {
        return $this->belongsTo('App\Customer','customer_id','customer_id');
        
  }public function gstsell_products() {
    return $this->hasMany('App\GstSellProduct','sell_id');
}


}

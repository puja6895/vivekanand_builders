<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GstSellProduct extends Model
{
    //
    protected $table = 'gst_sell_products';
    protected $primarykey = 'id';

    public function gstsells(){
        return $this->belongsTo('App\GstSell','id');
    }

    public function product() {
		return $this->belongsTo('App\Product', 'product_id','product_id');
    }
   
}

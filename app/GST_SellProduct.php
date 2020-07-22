<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GST_SellProduct extends Model
{
    //
    protected $table = 'gst_sell_products';
    protected $primarykey = 'gst_sell_product_id';

    public function gst_sells(){
        return $this->belongsTo('App\GST_Sell','gst_sell_id');
    }
    public function product() {
		return $this->belongsTo('App\Product', 'product_id');
    }
}

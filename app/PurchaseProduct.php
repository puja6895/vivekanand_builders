<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseProduct extends Model
{
    //
    protected $table = 'purchase_products';
    protected $primarykey = 'purchase_product_id';


    public function purchases(){
        return $this->belongsTo('App\Purchase','purchase_id');
    }
    public function product() {
		return $this->belongsTo('App\Product', 'product_id');
    }
    public function unit() {
		return $this->belongsTo('App\Unit', 'unit_id');
    }

}

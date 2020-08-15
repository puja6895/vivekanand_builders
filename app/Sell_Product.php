<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sell_Product extends Model
{
    //
    protected $table = 'sell_products';
    protected $primarykey = 'sell_products_id';

    public function sells(){
        return $this->belongsTo('App\Sell','sell_id');
    }
    public function product() {
		return $this->belongsTo('App\Product', 'product_id','product_id');
    }

    public function unit() {
      return $this->belongsTo('App\Unit', 'unit_id','unit_id');
      }
   
}

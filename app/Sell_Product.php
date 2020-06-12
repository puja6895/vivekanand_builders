<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sell_Product extends Model
{
    //
    protected $table = 'sell_products';
    protected $primarykey = 'sell_product_id';

    public function sells(){
        return $this->belongsTo('App\Sell');
    }
}

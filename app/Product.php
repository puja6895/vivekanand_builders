<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    //
    protected $primaryKey = 'product_id';

    use SoftDeletes;

    public function inventory() 
    {
		    return $this->hasMany('App\Inventory','product_id');
    }
    
    public function sell_products() 
    {
		    return $this->hasMany('App\Sell_Product','product_id');
    }

    public function purchase_products() 
    {
		    return $this->hasMany('App\PurchaseProduct','product_id');
    }

}

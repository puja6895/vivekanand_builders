<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Default_Product extends Model
{
    //
    protected $table = 'default__products';
    protected $primarykey = 'default_product_id';

    // Product
	public function product() {
		return $this->belongsTo('App\Product', 'product_id', 'product_id');
	}

	// Unit
	public function unit() {
		return $this->belongsTo('App\Unit', 'unit_id', 'unit_id');
	}
}

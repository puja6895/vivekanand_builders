<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    //
    protected $table = 'invent';
    protected $primarykey = 'id';

    public function product() {
		return $this->belongsTo('App\Product', 'product_id', 'product_id');
	}

	// Unit
	public function unit() {
		return $this->belongsTo('App\Unit', 'unit_id', 'unit_id');
	}
}

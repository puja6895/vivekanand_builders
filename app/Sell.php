<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Sell extends Model
{
    //
    protected $primaryKey = 'sell_id';

    // use SoftDeletes;

    public function customer() {
		return $this->belongsTo('App\Customer','customer_id');
  }
  
  public function sell_products() {
		return $this->hasMany('App\Sell_Product','sell_id');
	}
}

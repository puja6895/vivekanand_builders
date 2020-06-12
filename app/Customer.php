<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    // protected $table = 'customer';
    protected $primaryKey = 'customer_id';

    public function sell() {
		return $this->hasMany('App\Sell');
	}
}

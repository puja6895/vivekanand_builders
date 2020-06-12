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
		return $this->belogsTo('App\Customer');
	}
}

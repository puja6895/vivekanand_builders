<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LorryReport extends Model
{
    //
    protected $table = 'lorry_reports';
    protected $primarykey = 'id';

    public function customer() {
		return $this->hasMany('App\Customer','customer_id','customer_id');
  }

  public function product() {
    return $this->hasMany('App\Product','product_id','product_id');
    }

    public function unit() {
        return $this->hasMany('App\Unit','unit_id','unit_id');
    }

    public function lorry() {
        return $this->belongsTo('App\Lorry','lorry_id','lorry_id');
    }
}

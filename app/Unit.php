<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    //
    protected $primaryKey = 'unit_id';

    use SoftDeletes;
    public function inventory() {
		return $this->hasMany('App\Inventory','unit_id');
  }
  public function default_product() {
		return $this->belongsTo('App\Default_Product','defult_id','defult_id');
  }
}

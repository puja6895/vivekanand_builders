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

}

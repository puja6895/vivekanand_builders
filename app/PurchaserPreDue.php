<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaserPreDue extends Model
{
    //
    protected $table = 'purchaser_dues_amt';
    protected $primarykey = 'id';

    public function purchaser() {
		return $this->belongsTo('App\Purchaser','purchaser_id','purchaser_id');
  }
}

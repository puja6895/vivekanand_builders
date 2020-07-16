<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    //
    protected $primaryKey = 'purchase_id';


    public function purchasers() {
		return $this->belongsTo('App\Purchaser','purchaser_id','purchaser_id');
  }
  
  public function purchase_products() {
		return $this->hasMany('App\PurchaseProduct','purchase_id');
    }

    

}

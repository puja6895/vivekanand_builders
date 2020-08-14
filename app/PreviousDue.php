<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreviousDue extends Model
{
    //
    protected $table = 'previous_due';
    protected $primarykey = 'id';

    public function customer() {
		return $this->belongsTo('App\Customer','customer_id','customer_id');
  }
}

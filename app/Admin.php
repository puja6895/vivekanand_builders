<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    //
    protected $table = 'admins';
    protected $primarykey = 'admin_id';

    public function bills(){
        return $this->hasMany('App\BillDetail','bill_id');
    }
}

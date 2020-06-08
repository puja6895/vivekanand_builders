<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Categorie extends Model
{
    //
    protected $primaryKey = 'categorie_id';

    use SoftDeletes;
}

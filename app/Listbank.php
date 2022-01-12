<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listbank extends Model
{

    protected $table = "list_bank";
    protected $guarded = ['id'];
    public $timestamps = false;
}

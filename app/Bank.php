<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{

    protected $table = "bank";
    protected $guarded = ['id'];
    public $timestamps = false;
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class D_booking extends Model
{
    protected $table = "d_booking";
    protected $guarded = ['id'];
    public $timestamps = false;
}

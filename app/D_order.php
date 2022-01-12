<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class D_order extends Model
{
    protected $table = "d_order_pakan";
    protected $guarded = ['id'];
    public $timestamps = false;
}

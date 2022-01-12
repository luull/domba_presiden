<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class D_beli extends Model
{
    protected $table = "d_beli_pakan";
    protected $guarded = ['id'];
    public $timestamps = false;
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dummy_beli extends Model
{
    protected $table = "dummy_beli";
    protected $guarded = ['id'];
    public $timestamps = false;
}

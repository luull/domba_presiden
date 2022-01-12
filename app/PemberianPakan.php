<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PemberianPakan extends Model
{
    protected $table = "pemberian_pakan";
    protected $guarded = ['id'];
    public $timestamps = false;
}

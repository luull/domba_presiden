<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dummy_do extends Model
{
    protected $table = "dummy_do";
    protected $guarded = ['id'];
    public $timestamps = false;
}

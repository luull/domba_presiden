<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penimbangan extends Model
{
    protected $table = "penimbangan";
    protected $guarded = ['id'];
    public $timestamps = false;
}
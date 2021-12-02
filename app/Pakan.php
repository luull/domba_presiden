<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pakan extends Model
{
    protected $table = "pakan";
    protected $guarded = ['id'];
    public $timestamps = false;
}
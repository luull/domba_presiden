<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    protected $table = "satuan_pakan";
    protected $guarded = ['id'];
    public $timestamps = false;
}
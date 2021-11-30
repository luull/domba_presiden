<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StokPakan extends Model
{
    protected $table = "stok_pakan";
    protected $guarded = ['id'];
    public $timestamps = false;
}
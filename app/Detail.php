<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $table = "detail_order";
    protected $guarded = ['id'];
    public $timestamps = false;
}
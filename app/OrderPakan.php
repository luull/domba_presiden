<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderPakan extends Model
{
    protected $table = "order_pakan";
    protected $guarded = ['id'];
    public $timestamps = false;
}
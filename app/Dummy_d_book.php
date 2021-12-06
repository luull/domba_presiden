<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dummy_d_book extends Model
{
    protected $table = "dummy_d_booking";
    protected $guarded = ['id'];
    public $timestamps = false;
}
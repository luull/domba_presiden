<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dummy_h_book extends Model
{
    protected $table = "dummy_h_booking";
    protected $guarded = ['id'];
    public $timestamps = false;
}
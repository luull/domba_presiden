<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegisDomba extends Model
{
    protected $table = "regis_domba";
    protected $guarded = ['id'];
    public $timestamps = false;
}
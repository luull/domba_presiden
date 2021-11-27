<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisDomba extends Model
{
    protected $table = "jenis_domba";
    protected $guarded = ['id'];
    public $timestamps = false;
}
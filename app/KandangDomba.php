<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KandangDomba extends Model
{
    protected $table = "kandang_domba";
    protected $guarded = ['id'];
    public $timestamps = false;
}
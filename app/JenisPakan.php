<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisPakan extends Model
{
    protected $table = "jenis_pakan";
    protected $guarded = ['id'];
    public $timestamps = false;
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PemberianPakanDetil extends Model
{
    protected $table = "pemberian_pakan_detil";
    protected $guarded = ['id'];
    public $timestamps = false;
}

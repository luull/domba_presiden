<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dummy_jual extends Model
{
    protected $table = "dummy_jual";
    protected $guarded = ['id'];
    public $timestamps = false;
    public function domba()
    {
        return $this->hasOne(RegisDomba::class, 'no_regis', 'no_regis');
    }
}

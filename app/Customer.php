<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    protected $table = "customer";
    protected $guarded = ['id'];
    public $timestamps = false;
    public function h_jual()
    {
        return $this->belongsTo(H_jual::class, 'id', 'id_customer');
    }
}

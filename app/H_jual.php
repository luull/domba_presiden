<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class H_jual extends Model
{
    protected $table = "h_jual";
    protected $guarded = ['id'];
    public $timestamps = false;
    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'id_customer');
    }
}

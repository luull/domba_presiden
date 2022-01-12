<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class H_booking_temp extends Model
{
    protected $table = "h_booking_temp";
    protected $guarded = ['id'];
    public $timestamps = false;
    public function investor()
    {
        return $this->hasOne(Investor::class, 'id', 'id_investor');
    }
}

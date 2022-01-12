<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investor extends Model
{

    protected $table = "investor";
    protected $guarded = ['id'];
    public $timestamps = false;
    public function h_booking()
    {
        return $this->belongsTo(H_booking::class, 'id', 'id_investor');
    }
}

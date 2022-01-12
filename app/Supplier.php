<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = "supplier";
    protected $guarded = ['id'];
    public $timestamps = false;
    public function h_order()
    {
        return $this->belongsTo(H_order::class, 'id', 'supplier_id');
    }
    public function h_beli()
    {
        return $this->belongsTo(H_beli::class, 'id', 'supplier_id');
    }
    public function pakan()
    {
        return $this->hasMany(Pakan::class, 'id', 'supplier');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class H_beli extends Model
{
    protected $table = "h_beli_pakan";
    protected $guarded = ['id'];
    public $timestamps = false;
    public function supplier()
    {
        return $this->hasOne(Supplier::class, 'id', 'supplier_id');
    }
}

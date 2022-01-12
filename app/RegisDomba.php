<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegisDomba extends Model
{
    protected $table = "regis_domba";
    protected $guarded = ['id'];
    public $timestamps = false;
    public function status_domba()
    {
        return $this->hasOne(Status_domba::class, 'status', 'status');
    }
    public function dummy_jual()
    {
        return $this->belongsTo(Dummy_jual::class, 'no_regis', 'no_regis');
    }
}

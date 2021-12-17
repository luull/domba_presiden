<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status_domba extends Model
{
    protected $table = "status_domba";
    public function domba()
    {
        return $this->belongsTo(RegisDomba::class, 'status', 'status');
    }
}

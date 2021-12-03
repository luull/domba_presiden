<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = "province";
    protected $fillable = ['province_id', 'province'];
    public function city()
    {
        return $this->hasMany(City::class, 'province_id', 'province_id');
    }
    public function member()
    {
        return $this->belongsTo(Member::class, 'propinsi', 'province_id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class, 'propinsi', 'province_id');
    }
}

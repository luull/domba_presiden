<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = "city";
    protected $fillable = ['city_id', 'province_id', 'type', 'city_name', 'postal_code'];
    public function subdistrict()
    {
        return $this->hasMany(Subdistrict::class, 'city_id', 'city_id');
    }
    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'province_id');
    }
    public function member()
    {
        return $this->belongsTo(Member::class, 'kota', 'city_id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class, 'kota', 'city_id');
    }
}

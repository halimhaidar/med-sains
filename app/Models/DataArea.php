<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataArea extends Model
{
    use HasFactory;

    protected $fillable = [
        'province_code',
        'province_name',
        'city_code',
        'city_name',
        'district_code',
        'district_name',
        'subdistrict_code',
        'subdistrict_name'
    ];
}

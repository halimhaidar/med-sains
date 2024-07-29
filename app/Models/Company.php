<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'company',
        'division',
        'segment',
        'website',
        'npwp',
        'address',
        'phone',
        'sub_segment',
        'social_media',
        'post_code',
        'pic',
        'created_by',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'salutation',
        'name',
        'academic_degree',
        'job_title',
        'gender',
        'company_id',
        'company',
        'email',
        'phone',
        'segment',
        'sub_segment',
        'province',
        'city',
        'address',
        'post_code',
        'pic',
        'created_by',
    ];
}

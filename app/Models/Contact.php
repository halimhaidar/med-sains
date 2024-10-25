<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id'); // 'company_id' is the foreign key
    }

    public function addresses()
    {
        return $this->hasMany(Contact_address::class);  // Updated model name
    }

    public function defaultAddress()
    {
        return $this->hasOne(Contact_address::class)->where('default', 1);
    }

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

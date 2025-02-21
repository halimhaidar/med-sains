<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public function contacts()
    {
        return $this->hasMany(Contact::class, 'company_id'); // 'company_id' is the foreign key
    }

    public function area()
    {
    return $this->belongsTo(DataArea::class, 'subdistrict_code', 'subdistrict_code');
    }

    protected $fillable = [
        'company',
        'division',
        'segment',
        'website',
        'npwp',
        'subdistrict_code',
        'address',
        'phone',
        'sub_segment',
        'social_media',
        'post_code',
        'pic',
        'created_by',
    ];
}

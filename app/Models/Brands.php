<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    use HasFactory;
    
    public function products()
    {
        return $this->hasMany(Products::class,'brand_id');
    }


    protected $fillable = [
        'name',
        'handle_by',
        'category_id',
        'category_name',
        'image_brand',
        'description',
        'vendor_id',
        'vendor_name',
        'sq_target',
        'so_target',
        'sales_target',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'catalog',
        'category',
        'brand_id',
        'brand_name',
        'status',
        'price',
        'stock',
        'safety_stock',
        'attachment',
        'ecatalog_link',
        'description',
    ];
}

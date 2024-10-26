<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactAddress extends Model
{
    use HasFactory;
    // protected $fillable = [
    //     'contact_id',
    //     'email',
    //     'phone',
    //     'province',
    //     'city',
    //     'address',
    //     'post_code',
    //     'default'
    // ];

    protected $guarded = [];
}

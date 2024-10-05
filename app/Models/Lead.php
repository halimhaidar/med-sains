<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_id',
        'contact_name',
        'contact_phone',
        'contact_company',
        'contact_email',
        'source',
        'segment',
        'status',
        'description',
        'assign_to',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'assign_to');
    }


    public $incrementing = false; // Important for non-numeric IDs
    protected $keyType = 'string'; // Ensure the ID is treated as a string

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($lead) {
            // Get the last lead by ID in descending order
            $lastLead = Lead::orderBy('id', 'desc')->first();

            if ($lastLead) {
                // Extract numeric part from the ID
                $lastIdNumber = (int)substr($lastLead->id, 2);
                // Increment the numeric part for the new ID
                $nextId = $lastIdNumber + 1;
            } else {
                // If no lead exists, start with 1
                $nextId = 1;
            }

            // Format the new ID with 'LE' prefix and zero-padded number
            $lead->id = 'LE' . str_pad($nextId, 2, '0', STR_PAD_LEFT);
        });
    }
}

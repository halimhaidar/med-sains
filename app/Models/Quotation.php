<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id');
    }

    public function contactAddress()
    {
        return $this->belongsTo(ContactAddress::class, 'contact_address_id');
    }

    protected $fillable = [
        'lead_id',
        'contact_address_id',
        'category',
        'closing_date_target',
        'source',
        'description',
        'franco',
        'validity',
        'delivery_estimation',
        'delivery_condition',
        'term_of_payment',
        'sales_id',
        'sales_signature',
        'pdf_show',
        'pdf_show_decimal',
        'margin_1',
        'margin_2',
    ];

    public $incrementing = false; // Disable auto-incrementing
    protected $keyType = 'string'; // Set the ID to be a string

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($quotation) {
            $lastQuotation = Quotation::orderBy('id', 'desc')->first();

            if ($lastQuotation) {
                // Extract the numeric part from the last ID
                $lastIdNumber = (int)substr($lastQuotation->id, 2);
                // Increment the numeric part for the new ID
                $nextId = $lastIdNumber + 1;
            } else {
                // If no quotation exists, start with SQ0204001
                $nextId = 204001; 
            }

            // Format the new ID with 'SQ' prefix and zero-padded number
            $quotation->id = 'SQ' . str_pad($nextId, 7, '0', STR_PAD_LEFT);
        });
    }
}

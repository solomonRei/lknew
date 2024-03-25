<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_profile_id',
        'country',
        'city',
        'street',
        'building',
        'apartment',
        'is_active',
    ];

    public function userProfile()
    {
        return $this->belongsTo(UserProfile::class);
    }

    /**
     * Get the address in a custom format.
     *
     * @return string
     */
    public function getFormattedAddressAttribute(): string
    {
        $parts = [
            $this->country,
            'г. ' . $this->city,
            'ул. ' . $this->street,
            'д. ' . $this->building,
        ];

        if (!empty($this->apartment)) {
            $parts[] = 'кв. ' . $this->apartment;
        }

        return implode(', ', $parts);
    }
}

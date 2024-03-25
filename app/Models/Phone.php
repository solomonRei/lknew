<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_profile_id',
        'phone',
        'is_active',
    ];

    public function userProfile()
    {
        return $this->belongsTo(UserProfile::class);
    }
}

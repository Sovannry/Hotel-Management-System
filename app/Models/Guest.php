<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Guest extends Model
{
    protected $fillable = ['full_name', 'email', 'phone', 'gender', 'address', 'identity_number'];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoomType extends Model
{
    protected $fillable = ['name', 'description', 'base_price', 'capacity'];

    protected function casts(): array
    {
        return ['base_price' => 'decimal:2', 'capacity' => 'integer'];
    }

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }
}

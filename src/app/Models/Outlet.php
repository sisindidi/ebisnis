<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Outlet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'description',
        'is_active',
    ];

    protected static function booted(): void
    {
        static::creating(function (Outlet $outlet) {
            if (empty($outlet->slug)) {
                $outlet->slug = Str::slug($outlet->name);
            }
        });
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
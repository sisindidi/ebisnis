<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['outlet_id', 'name', 'category', 'image', 'description', 'price', 'is_available'];

    public function outlet()
    {
        return $this->belongsTo(Outlet::class);
    }

    private static array $resolvedUrlCache = [];

    /**
     * Resolve menu image URL, falling back to local public/images assets when DB storage files are absent.
     */
    public static function resolveImageUrl(?string $imageVal, string $name): string
    {
        $cacheKey = ($imageVal ?? '') . '|' . $name;
        if (isset(self::$resolvedUrlCache[$cacheKey])) {
            return self::$resolvedUrlCache[$cacheKey];
        }

        return self::$resolvedUrlCache[$cacheKey] = self::computeImageUrl($imageVal, $name);
    }

    private static function computeImageUrl(?string $imageVal, string $name): string
    {
        if (! empty($imageVal)) {
            if (str_starts_with($imageVal, 'http')) {
                return $imageVal;
            }
            if (str_starts_with($imageVal, 'images/') || str_starts_with($imageVal, 'image/')) {
                $clean = preg_replace('#^image/#', 'images/', $imageVal);
                $base = basename($clean);
                if (file_exists(public_path('images/menus/' . $base))) {
                    return asset('images/menus/' . $base);
                }
                if (file_exists(public_path('images/' . $base))) {
                    return asset('images/' . $base);
                }
                if (file_exists(public_path($clean))) {
                    return asset($clean);
                }
            } else {
                $trimmed = ltrim($imageVal, '/');
                if (file_exists(public_path('images/' . $trimmed))) {
                    return asset('images/' . $trimmed);
                }
                if (file_exists(public_path('images/menus/' . basename($trimmed)))) {
                    return asset('images/menus/' . basename($trimmed));
                }
                if (file_exists(public_path('storage/' . $trimmed))) {
                    return asset('storage/' . $trimmed);
                }
            }
        }

        $slug = Str::slug($name);
        $lower = strtolower(trim($name));
        foreach (['jpg', 'jpeg', 'png', 'webp'] as $ext) {
            if (file_exists(public_path("images/menus/{$slug}.{$ext}"))) {
                return asset("images/menus/{$slug}.{$ext}");
            }
            foreach ([$name, $lower, $slug] as $candidate) {
                if (file_exists(public_path("images/{$candidate}.{$ext}"))) {
                    return asset("images/{$candidate}.{$ext}");
                }
            }
        }

        if (str_contains($lower, 'bakso') || str_contains($lower, 'baso')) return 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?auto=format&fit=crop&w=600&q=80';
        if (str_contains($lower, 'nasi goreng')) return 'https://images.unsplash.com/photo-1512058564366-18510be2db19?auto=format&fit=crop&w=600&q=80';
        if (str_contains($lower, 'geprek') || str_contains($lower, 'bakar') || str_contains($lower, 'cabe')) return 'https://images.unsplash.com/photo-1601050690597-df0568f70950?auto=format&fit=crop&w=600&q=80';
        if (str_contains($lower, 'mie') || str_contains($lower, 'indomie')) return 'https://images.unsplash.com/photo-1559847844-5315695dadae?auto=format&fit=crop&w=600&q=80';
        if (str_contains($lower, 'otak') || str_contains($lower, 'cimol')) return 'https://images.unsplash.com/photo-1563379091339-03b21ab4a4f8?auto=format&fit=crop&w=600&q=80';
        if (str_contains($lower, 'sosis')) return 'https://images.unsplash.com/photo-1541544741938-0af808871cc0?auto=format&fit=crop&w=600&q=80';
        if (str_contains($lower, 'kentang')) return 'https://images.unsplash.com/photo-1576107232684-1279f3908594?auto=format&fit=crop&w=600&q=80';
        if (str_contains($lower, 'jeruk')) return 'https://images.unsplash.com/photo-1613478223719-2ab802602423?auto=format&fit=crop&w=600&q=80';
        if (str_contains($lower, 'teh')) return 'https://images.unsplash.com/photo-1556679343-c7306c1976bc?auto=format&fit=crop&w=600&q=80';

        return 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=600&q=80';
    }
}
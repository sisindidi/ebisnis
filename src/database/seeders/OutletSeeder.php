<?php

namespace Database\Seeders;

use App\Models\Outlet;
use Illuminate\Database\Seeder;

class OutletSeeder extends Seeder
{
    public function run(): void
    {
        Outlet::create(['name' => 'Kantin Mbok Darmi', 'slug' => 'mbok-darmi', 'is_active' => true]);
        Outlet::create(['name' => 'Ayam Geprek Kampus', 'slug' => 'ayam-geprek', 'is_active' => true]);
        Outlet::create(['name' => 'Kedai Kopi & Teh', 'slug' => 'kedai-kopi', 'is_active' => true]);
        Outlet::create(['name' => 'Warung Nasi Goreng', 'slug' => 'nasgor', 'is_active' => true]);
    }
}
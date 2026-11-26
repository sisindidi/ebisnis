<?php

namespace Database\Seeders;

use App\Models\Outlet;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Super Admin (Akses Pusat / Semua Outlet)
        $superAdmin = User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'outlet_id' => null,
            ]
        );
        $superAdmin->syncRoles(['super_admin']);

        // 2. Akun Admin khusus per Outlet
        $outlets = Outlet::all();
        foreach ($outlets as $outlet) {
            $slugClean = str_replace(['-', ' '], '', strtolower($outlet->slug));
            $email = 'admin.' . $slugClean . '@admin.com';

            $outletUser = User::updateOrCreate(
                ['email' => $email],
                [
                    'name' => 'Admin ' . $outlet->name,
                    'password' => Hash::make('password'),
                    'outlet_id' => $outlet->id,
                ]
            );
            $outletUser->syncRoles(['user']);
        }
    }
}

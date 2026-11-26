<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Role::firstOrCreate(['name' => 'super_admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Permissions untuk Admin Outlet
        $outletPermissions = [
            // Menu (Bisa lihat, tambah menu baru, edit, hapus)
            'view_any_menu',
            'view_menu',
            'create_menu',
            'update_menu',
            'delete_menu',
            'delete_any_menu',

            // Orders / Pesanan (Bisa lihat pesanan outlet & update statusnya)
            'view_any_order',
            'view_order',
            'update_order',

            // Detail Pesanan Items (Bisa lihat rincian menu yang pipesan pembeli)
            'view_any_order::item',
            'view_order::item',
            'update_order::item',

            // Outlet (Bisa lihat & ubah info/foto outlet sendiri)
            'view_any_outlet',
            'view_outlet',
            'update_outlet',
        ];

        // Daftarkan permissions ke database
        foreach ($outletPermissions as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName, 'guard_name' => 'web']);
        }

        // Berikan permissions ke role user (Admin Outlet)
        $userRole->syncPermissions($outletPermissions);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Outlet;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Menu::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 1. ESA CORNER
        $esa = Outlet::updateOrCreate(
            ['id' => 1],
            [
                'name' => 'Esa Corner',
                'slug' => 'esa-corner',
                'description' => 'Pusat jajanan burger, ayam krispi, camilan dan es kopi kekinian',
                'is_active' => true,
            ]
        );

        $esaMenus = [
            [
                'name' => 'Ayam Geprek',
                'category' => 'makanan',
                'image' => 'menus/ayam-geprek.jpg',
                'description' => 'Ayam krispi gurih digeprek dengan sambal cabai rawit pedas nikmat khas Esa Corner.',
                'price' => 16000,
                'is_available' => true,
            ],
            [
                'name' => 'Ayam Popcorn',
                'category' => 'cemilan',
                'image' => 'menus/ayam-popcorn.jpg',
                'description' => 'Potongan ayam renyah empuk dibalut tepung bumbu gurih yang renyah nagih.',
                'price' => 14000,
                'is_available' => true,
            ],
            [
                'name' => 'Burger',
                'category' => 'makanan',
                'image' => 'menus/burger.jpg',
                'description' => 'Burger lezat dengan patty daging gurih, selada segar, keju dan saus racikan spesial.',
                'price' => 15000,
                'is_available' => true,
            ],
            [
                'name' => 'Es Kopi',
                'category' => 'minuman',
                'image' => 'menus/es-kopi.jpg',
                'description' => 'Kopi susu dingin segar beraroma harum penambah semangat saat jeda kuliah.',
                'price' => 8000,
                'is_available' => true,
            ],
            [
                'name' => 'Es Krim',
                'category' => 'cemilan',
                'image' => 'menus/es-krim.jpg',
                'description' => 'Es krim manis lembut dingin yang memanjakan lidah di siang hari.',
                'price' => 7000,
                'is_available' => true,
            ],
            [
                'name' => 'Kentang Goreng',
                'category' => 'cemilan',
                'image' => 'menus/kentang-goreng.jpg',
                'description' => 'French fries renyah keemasan bertabur gurih bumbu ditemani cocolan saus.',
                'price' => 10000,
                'is_available' => true,
            ],
        ];

        foreach ($esaMenus as $item) {
            Menu::create(array_merge($item, ['outlet_id' => $esa->id]));
        }

        // 2. KEDAI MAMICI (Kantin Mamici)
        $mamici = Outlet::updateOrCreate(
            ['id' => 2],
            [
                'name' => 'Kantin Mamici',
                'slug' => 'kantin-mamici',
                'description' => 'Spesialis baso aci, baso urat, mie ayam gurih, dan aneka jajanan lezat',
                'is_active' => true,
            ]
        );

        $mamiciMenus = [
            [
                'name' => 'Cimol',
                'category' => 'cemilan',
                'image' => 'menus/cimol.jpg',
                'description' => 'Cimol bulat kenyal hangat bertabur bumbu asin gurih pedas khas Mamici.',
                'price' => 10000,
                'is_available' => true,
            ],
            [
                'name' => 'Otak Otak',
                'category' => 'cemilan',
                'image' => 'menus/otak-otak.jpg',
                'description' => 'Otak-otak ikan goreng gurih mekar dengan saus cocolan sedap.',
                'price' => 10000,
                'is_available' => true,
            ],
            [
                'name' => 'Baso Aci',
                'category' => 'makanan',
                'image' => 'menus/baso-aci.jpg',
                'description' => 'Baso aci kenyal isi dengan kuah pedas gurih segar perasan jeruk limau.',
                'price' => 12000,
                'is_available' => true,
            ],
            [
                'name' => 'Mie Ayam',
                'category' => 'makanan',
                'image' => 'menus/mie-ayam.jpg',
                'description' => 'Mie kenyal dengan potongan ayam semur gurih manis lengkap dengan sawi segar.',
                'price' => 13000,
                'is_available' => true,
            ],
            [
                'name' => 'Baso Urat',
                'category' => 'makanan',
                'image' => 'menus/baso-urat.jpeg',
                'description' => 'Bakso urat sapi asli kenyal berdaging dengan kuah kaldu sapi gurih mantap.',
                'price' => 18000,
                'is_available' => true,
            ],
            [
                'name' => 'Air Mineral',
                'category' => 'minuman',
                'image' => 'menus/air-mineral.jpg',
                'description' => 'Air mineral botol dingin pelepas dahaga yang higienis dan segar.',
                'price' => 4000,
                'is_available' => true,
            ],
        ];

        foreach ($mamiciMenus as $item) {
            Menu::create(array_merge($item, ['outlet_id' => $mamici->id]));
        }

        // 3. WARUNG TEH NUR (Kantin Teh Nur)
        $tehnur = Outlet::updateOrCreate(
            ['id' => 3],
            [
                'name' => 'Kantin Teh Nur',
                'slug' => 'kantin-teh-nur',
                'description' => 'Menu ayam cabe hijau, ayam bawang putih mantap, aneka gorengan, dan jus segar',
                'is_active' => true,
            ]
        );

        $tehnurMenus = [
            [
                'name' => 'Ayam Bawang Putih',
                'category' => 'makanan',
                'image' => 'menus/ayam-bawang-putih.jpg',
                'description' => 'Ayam goreng wangi bawang putih meresap dengan tekstur renyah dan gurih sedap.',
                'price' => 15000,
                'is_available' => true,
            ],
            [
                'name' => 'Ayam Cabe Hijau',
                'category' => 'makanan',
                'image' => 'menus/ayam-cabe-hijau.jpg',
                'description' => 'Ayam empuk gurih dengan siraman ulekan sambal cabe hijau pedas segar.',
                'price' => 15000,
                'is_available' => true,
            ],
            [
                'name' => 'Gorengan',
                'category' => 'cemilan',
                'image' => 'menus/gorengan.jpg',
                'description' => 'Aneka gorengan hangat renyah garing teman santai paling pas.',
                'price' => 5000,
                'is_available' => true,
            ],
            [
                'name' => 'Teh Pucuk',
                'category' => 'minuman',
                'image' => 'menus/teh-pucuk.jpg',
                'description' => 'Teh melati manis kemasan dingin menyegarkan.',
                'price' => 5000,
                'is_available' => true,
            ],
            [
                'name' => 'Pop Mie',
                'category' => 'makanan',
                'image' => 'menus/pop-mie.jpg',
                'description' => 'Mie kuah instan hangat gurih yang pas disantap cepat di sela kuliah.',
                'price' => 8000,
                'is_available' => true,
            ],
            [
                'name' => 'Jus Buah',
                'category' => 'minuman',
                'image' => 'menus/jus-buah.jpg',
                'description' => 'Jus buah segar manis dingin kaya vitamin penyejuk suasana.',
                'price' => 8000,
                'is_available' => true,
            ],
        ];

        foreach ($tehnurMenus as $item) {
            Menu::create(array_merge($item, ['outlet_id' => $tehnur->id]));
        }

        // 4. KEDAI BU YANTI
        $buyanti = Outlet::updateOrCreate(
            ['id' => 4],
            [
                'name' => 'Kedai Bu Yanti',
                'slug' => 'kedai-bu-yanti',
                'description' => 'Aneka nasi goreng, kwetiau, mie goreng & rebus lezat resep khas Bu Yanti',
                'is_active' => true,
            ]
        );

        $buyantiMenus = [
            [
                'name' => 'Nasi Goreng',
                'category' => 'makanan',
                'image' => 'menus/nasi-goreng.jpg',
                'description' => 'Nasi goreng harum rempah komplit dengan telur mata sapi dan kerupuk renyah.',
                'price' => 15000,
                'is_available' => true,
            ],
            [
                'name' => 'Kwetiau Goreng',
                'category' => 'makanan',
                'image' => 'menus/kwetiau-goreng.jpg',
                'description' => 'Kwetiau goreng kenyal gurih dengan bumbu meresap, telur dan sayuran segar.',
                'price' => 15000,
                'is_available' => true,
            ],
            [
                'name' => 'Mie Goreng',
                'category' => 'makanan',
                'image' => 'menus/mie-goreng.jpg',
                'description' => 'Mie goreng lezat gurih manis dengan telur orak-arik dan taburan bawang goreng.',
                'price' => 13000,
                'is_available' => true,
            ],
            [
                'name' => 'Mie Rebus',
                'category' => 'makanan',
                'image' => 'menus/mie-rebus.jpg',
                'description' => 'Mie rebus kuah hangat gurih kaldu dengan telur dan sawi hijau segar.',
                'price' => 13000,
                'is_available' => true,
            ],
            [
                'name' => 'Kopi',
                'category' => 'minuman',
                'image' => 'menus/kopi.jpg',
                'description' => 'Kopi hangat / dingin mantap aroma nikmat khas racikan Kedai Bu Yanti.',
                'price' => 5000,
                'is_available' => true,
            ],
        ];

        foreach ($buyantiMenus as $item) {
            Menu::create(array_merge($item, ['outlet_id' => $buyanti->id]));
        }
    }
}

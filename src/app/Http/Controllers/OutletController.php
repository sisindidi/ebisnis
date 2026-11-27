<?php

namespace App\Http\Controllers;

use App\Models\Outlet;

class OutletController extends Controller
{
    public function index()
    {
        $collectedMenus = collect();
        $dbHealthy = true;

        $featuredTargets = [
            1 => ['ayam geprek', 'ayam popcorn'],
            2 => ['cimol', 'otak otak'],
            3 => ['ayam bawang putih', 'ayam cabe hijau'],
            4 => ['nasi goreng', 'kwetiau goreng'],
        ];

        try {
            $outlets = Outlet::where('is_active', true)
                ->with(['menus' => function ($q) {
                    $q->orderBy('id');
                }])
                ->orderBy('id')
                ->get();

            foreach ($outlets as $outlet) {
                $targetNames = $featuredTargets[$outlet->id] ?? [];
                $pickedForOutlet = 0;

                foreach ($targetNames as $targetName) {
                    $matched = $outlet->menus->first(fn ($m) => strtolower(trim($m->name)) === $targetName);
                    if ($matched) {
                        $matched->setRelation('outlet', $outlet);
                        $collectedMenus->push($matched);
                        $pickedForOutlet++;
                    }
                }

                if ($pickedForOutlet < 2) {
                    $existingIds = $collectedMenus->pluck('id')->all();
                    foreach ($outlet->menus as $menu) {
                        if ($pickedForOutlet >= 2) {
                            break;
                        }
                        if (! in_array($menu->id, $existingIds, true)) {
                            $menu->setRelation('outlet', $outlet);
                            $collectedMenus->push($menu);
                            $existingIds[] = $menu->id;
                            $pickedForOutlet++;
                        }
                    }
                }
            }
        } catch (\Throwable $e) {
            $dbHealthy = false;
            $outlets = collect();
        }

        if ($outlets->isEmpty()) {
            $outlets = collect([
                (object) ['id' => 1, 'name' => 'Esa Corner', 'description' => 'Pusat jajanan burger, ayam krispi, camilan dan es kopi kekinian'],
                (object) ['id' => 2, 'name' => 'Kantin Mamici', 'description' => 'Spesialis baso aci, baso urat, mie ayam gurih, dan aneka jajanan lezat'],
                (object) ['id' => 3, 'name' => 'Kantin Teh Nur', 'description' => 'Menu ayam cabe hijau, ayam bawang putih mantap, aneka gorengan, dan jus segar'],
                (object) ['id' => 4, 'name' => 'Kedai Bu Yanti', 'description' => 'Aneka nasi goreng, kwetiau, mie goreng & rebus lezat resep khas Bu Yanti'],
            ]);
        }

        $response = response()->view('index', compact('outlets', 'collectedMenus'));
        if ($dbHealthy && $collectedMenus->isNotEmpty()) {
            $response->header('Cache-Control', 'public, max-age=0, s-maxage=15, stale-while-revalidate=120');
        }

        return $response;
    }
}
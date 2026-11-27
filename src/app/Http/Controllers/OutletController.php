<?php

namespace App\Http\Controllers;

use App\Models\Outlet;

class OutletController extends Controller
{
    public function index()
    {
        $collectedMenus = collect();

        try {
            $outlets = Outlet::where('is_active', true)
                ->with(['menus' => function ($q) {
                    $q->where('is_available', true);
                }])
                ->orderBy('id')
                ->get();

            foreach ($outlets as $outlet) {
                foreach ($outlet->menus->take(2) as $menu) {
                    $menu->setRelation('outlet', $outlet);
                    $collectedMenus->push($menu);
                }
            }

            if ($collectedMenus->count() < 8) {
                $existingIds = $collectedMenus->pluck('id')->all();
                foreach ($outlets as $outlet) {
                    foreach ($outlet->menus as $menu) {
                        if ($collectedMenus->count() >= 8) {
                            break 2;
                        }
                        if (! in_array($menu->id, $existingIds, true)) {
                            $menu->setRelation('outlet', $outlet);
                            $collectedMenus->push($menu);
                            $existingIds[] = $menu->id;
                        }
                    }
                }
            }
        } catch (\Throwable $e) {
            $outlets = collect();
        }

        if ($outlets->isEmpty()) {
            $outlets = collect([
                (object) ['id' => 1, 'name' => 'Esa Corner'],
                (object) ['id' => 2, 'name' => 'Kantin Mamici'],
                (object) ['id' => 3, 'name' => 'Kantin Teh Nur'],
                (object) ['id' => 4, 'name' => 'Kedai Bu Yanti'],
            ]);
        }

        return view('index', compact('outlets', 'collectedMenus'));
    }
}
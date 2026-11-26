<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class OutletController extends Controller
{
    public function index()
    {
        if (Schema::hasTable('outlets')) {
            $outlets = Outlet::where('is_active', true)->get();
        } else {
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

        // Ganti 'kantin.index' jadi 'outlet.index'
        return view('index', compact('outlets'));
    }
}
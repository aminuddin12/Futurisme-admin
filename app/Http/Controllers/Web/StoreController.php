<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Vendor\VendorStore;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class StoreController extends Controller
{
    /**
     * Menampilkan halaman daftar semua toko (publik).
     */
    public function index(Request $request): Response
    {
        $stores = VendorStore::where('is_active', true)
            ->with('vendor') // Muat relasi pemilik vendor
            ->latest()
            ->paginate(12) // Ambil 12 toko per halaman
            ->withQueryString();

        // Merender halaman Inertia (React)
        // Pastikan Anda memiliki komponen 'Web/Stores/Index.tsx'
        return Inertia::render('Web/Stores/Index', [
            'stores' => $stores,
        ]);
    }

    /**
     * Menampilkan halaman detail satu toko beserta produknya (publik).
     */
    public function show(Request $request, string $slug): Response
    {
        $store = VendorStore::where('slug', $slug)
            ->where('is_active', true)
            ->with(['vendor']) // Muat data pemilik vendor
            ->firstOrFail();

        // Ambil produk yang terkait dengan toko ini
        $products = $store->products()
            ->where('is_active', true)
            ->latest()
            ->paginate(12) // 12 produk per halaman
            ->withQueryString();

        // Merender halaman Inertia (React)
        // Pastikan Anda memiliki komponen 'Web/Stores/Show.tsx'
        return Inertia::render('Web/Stores/Show', [
            'store' => $store,
            'products' => $products,
        ]);
    }
}

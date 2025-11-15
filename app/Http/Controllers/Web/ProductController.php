<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Vendor\VendorProduct;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    /**
     * Menampilkan halaman daftar semua produk (publik).
     */
    public function index(Request $request): Response
    {
        $products = VendorProduct::where('is_active', true)
            ->with('store') // Muat relasi toko
            ->latest()
            ->paginate(24) // Ambil 24 produk per halaman
            ->withQueryString();

        // Merender halaman Inertia (React)
        // Pastikan Anda memiliki komponen 'Web/Products/Index.tsx'
        return Inertia::render('Web/Products/Index', [
            'products' => $products,
        ]);
    }

    /**
     * Menampilkan halaman detail satu produk (publik).
     */
    public function show(Request $request, string $slug): Response
    {
        $product = VendorProduct::where('slug', $slug)
            ->where('is_active', true)
            ->with(['store.vendor']) // Muat toko dan pemilik vendornya
            ->firstOrFail();

        // Merender halaman Inertia (React)
        // Pastikan Anda memiliki komponen 'Web/Products/Show.tsx'
        return Inertia::render('Web/Products/Show', [
            'product' => $product,
        ]);
    }
}

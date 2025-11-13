<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan; // <-- 1. Import Artisan
use Illuminate\Support\Facades\Cache;   // <-- 2. Import Cache
use Inertia\Inertia;

class WebSettingsController extends Controller
{
    /**
     * Menampilkan halaman pengaturan.
     */
    public function index()
    {
        // Mengambil semua pengaturan untuk ditampilkan di form
        $settings = WebConfig::all()->pluck('value', 'key');
        return Inertia::render('Settings/WebSettings', [
            'settings' => $settings
        ]);
    }

    /**
     * Memperbarui pengaturan.
     */
    public function update(Request $request)
    {
        // Validasi bisa ditambahkan di sini
        // $request->validate([...]);

        $settings = $request->all();

        foreach ($settings as $key => $value) {
            // Update atau buat data di database
            WebConfig::updateOrCreate(
                ['key' => $key],
                ['value' => $value ?? '']
            );

            // 3. Perbarui nilai di Cache aplikasi secara instan
            // Kita gunakan 'forever' agar cache tidak pernah kadaluwarsa
            // kecuali kita perbarui lagi.
            Cache::forever($key, $value ?? '');
        }

        // 4. LANGKAH PALING PENTING
        // Setelah memperbarui prefix rute (misal: 'auth_path_insider'),
        // kita WAJIB membersihkan cache rute agar Laravel
        // membaca ulang RouteServiceProvider dan menggunakan prefix baru.
        Artisan::call('route:clear');

        return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui.');
    }
}

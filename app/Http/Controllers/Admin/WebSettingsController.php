<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class WebSettingsController extends Controller
{
    /**
     * Menampilkan halaman pengaturan web.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        // 1. Ambil data untuk form
        $settingsData = WebConfig::whereIn('function', ['identity', 'general', 'regional', 'maintenance'])
            ->get()
            ->keyBy('name')
            ->map(function ($item) {
                return $item->value;
            });

        // 2. Ambil data untuk menu sidebar
        $menuGroups = WebConfig::where('function', 'sidebar_group')
            ->with('children') // Eager load items
            ->orderBy('order')
            ->get()
            ->map(function ($group) {
                return [
                    'title' => $group->value['display_name'] ?? 'Unnamed Group',
                    'items' => $group->children->map(function ($item) {
                        return [
                            'key' => $item->name,
                            'label' => $item->value['display_name'] ?? 'Unnamed Item',
                            'icon' => $item->value['icon'] ?? 'heroicons:question-mark-circle',
                        ];
                    })->sortBy('order')->values(),
                ];
            });

        return Inertia::render('Settings/WebSettings', [
            'settings' => $settingsData,
            'menuGroups' => $menuGroups,
            'pageTitle' => 'Web Settings', // Menambahkan judul halaman
        ]);
    }

    /**
     * Memperbarui pengaturan web.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        // Validasi input sesuai dengan struktur data di seeder
        $validatedData = $request->validate([
            'sitename.value' => 'required|string|max:255',
            'site_url.url' => 'required|url',
            'site_locale.code' => 'required|string|in:id,en',
            'site_timezone.zone' => 'required|string|timezone:all',
            'site_status.status' => 'required|string|in:live,maintenance',
            'site_logo.path' => 'nullable|string', // Validasi untuk logo bisa disesuaikan
        ]);

        // Iterasi melalui data yang divalidasi dan perbarui di database
        foreach ($validatedData as $name => $value) {
            // Gunakan updateOrCreate untuk menyederhanakan logika
            // dan menangani kasus jika config belum ada.
            WebConfig::updateOrCreate(
                ['name' => $name],
                ['value' => function ($currentValue) use ($value) {
                    // Ambil data JSON yang ada, lalu gabungkan dengan data baru
                    $existingValue = json_decode($currentValue, true) ?? [];

                    return array_merge($existingValue, $value);
                }]
            );
        }

        // Redirect kembali ke halaman pengaturan dengan pesan sukses
        return Redirect::route('admin.settings')->with('success', 'Web settings updated successfully.');
    }
}

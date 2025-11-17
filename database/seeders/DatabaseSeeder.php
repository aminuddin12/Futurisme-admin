<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            RolesAndPermissionsSeeder::class,
            WebConfigSeeder::class,
            WebConfigDataSeeder::class,
            SidebarMenuSeeder::class,
            // Anda bisa menambahkan seeder lain di sini jika perlu
        ]);

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

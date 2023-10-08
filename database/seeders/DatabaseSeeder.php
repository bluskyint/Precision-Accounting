<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Page::factory()->count(8)->create();

//        $this->call([
//            CreatePermissionsSeeder::class,
//            CreateRolesSeeder::class,
//            CreateAdminSeeder::class,
//            SettingSeeder::class
//        ]);

    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Mohamed Elsayeh',
            'email' => 'mosayeh899@gmail.com',
            'password' => Hash::make('Saleh2015$'),
            'slug' => 'mohamed-elsayeh',
            'linkedin' => 'https://linkedin.com',
            'job_title' => 'Manager',
            'info' => 'Manager',
            'img' => ['src' => 'user-avatar.png', 'alt' => 'user image']
        ]);

        $role = Role::create(['name' => 'Admin']);

        $permissions = Permission::pluck('id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (['Admin', 'Author'] as $role) {
            Role::create(['name' => $role]);
        }

        $permissions = Permission::pluck('id')->all();

        $role = Role::findByName('Admin');
        $role->syncPermissions($permissions);
    }
}

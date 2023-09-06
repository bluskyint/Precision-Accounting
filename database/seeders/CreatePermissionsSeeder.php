<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class CreatePermissionsSeeder extends Seeder
{
    public function run(): void
    {
        //Permissions Categories
        $permissionsGroups = [
            [
                'name' => 'Users',
                'permissions' => [
                    'Show Users',
                    'Add Users',
                    'Edit Users',
                    'Delete Users'
                ]
            ],

            [
                'name' => 'Members',
                'permissions' => [
                    'Show Members',
                    'Add Members',
                    'Edit Members',
                    'Delete Members'
                ]
            ],

            [
                'name' => 'Roles',
                'permissions' => [
                    'Show Roles',
                    'Add Roles',
                    'Edit Roles',
                    'Delete Roles'
                ]
            ],

            [
                'name' => 'Articles',
                'permissions' => [
                    'Show Articles',
                    'Add Articles',
                    'Edit Articles',
                    'Delete Articles',
                    'Show Articles Trash',
                    'Restore Articles',
                    'ForceDelete Articles',
                ]
            ],

            [
                'name' => 'Services',
                'permissions' => [
                    'Show Services',
                    'Add Services',
                    'Edit Services',
                    'Delete Services',
                    'Show Services Trash',
                    'Restore Services',
                    'ForceDelete Services',
                ]
            ],

            [
                'name' => 'TaxCenters',
                'permissions' => [
                    'Show TaxCenters',
                    'Add TaxCenters',
                    'Edit TaxCenters',
                    'Delete TaxCenters',
                    'Show TaxCenters Trash',
                    'Restore TaxCenters',
                    'ForceDelete TaxCenters',
                ]
            ],

            [
                'name' => 'Categories',
                'permissions' => [
                    'Show Categories',
                    'Add Categories',
                    'Edit Categories',
                    'Delete Categories'
                ]
            ],

            [
                'name' => 'Resources',
                'permissions' => [
                    'Show Resources',
                    'Add Resources',
                    'Edit Resources',
                    'Delete Resources'
                ]
            ],

            [
                'name' => 'Testimonials',
                'permissions' => [
                    'Show Testimonials',
                    'Add Testimonials',
                    'Edit Testimonials',
                    'Delete Testimonials'
                ]
            ],

            [
                'name' => 'Newsletters',
                'permissions' => [
                    'Show Newsletters',
                    'Add Newsletters',
                    'Edit Newsletters',
                    'Delete Newsletters',
                ]
            ]
        ];


        foreach ($permissionsGroups as $group) {
            foreach ($group['permissions'] as $permission) {
                Permission::create(['name' => $permission, 'group_name' => $group['name'] ]);
            }
        }
    }
}

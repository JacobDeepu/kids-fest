<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'section list',
            'section create',
            'section edit',
            'section delete',
            'event list',
            'event create',
            'event edit',
            'event delete',
            'participant list',
            'transaction list',
            'filter by school'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $role = Role::findByName('Admin');
        $role->givePermissionTo($permissions);
    }
}

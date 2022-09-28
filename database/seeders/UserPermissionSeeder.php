<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'participant create']);
        Permission::create(['name' => 'participant edit']);
        Permission::create(['name' => 'transaction create']);

        $role = Role::findByName('User');
        $role->givePermissionTo([
            'participant create',
            'participant edit',
            'transaction create'
        ]);
    }
}

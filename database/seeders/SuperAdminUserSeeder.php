<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class SuperAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'Super Admin']);
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'User']);

        $adminUser = User::factory()->create([
            'email' => 'superadmin@admin.com',
            'password' => bcrypt('SecurePassword')
        ]);

        $adminUser->assignRole('Super Admin');
    }
}

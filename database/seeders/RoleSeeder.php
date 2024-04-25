<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'Admin',
                'description' => 'Has permission to edit information of all stores and staff.',
            ],
            [
                'name' => 'Store',
                'description' => 'Has permission to edit information of own store and staff.',
            ],
            [
                'name' => 'Staff',
                'description' => 'Has permission to edit own staff information only.',
            ],
        ];

        foreach ($roles as $roleData) {
            Role::create($roleData);
        }
    }
}
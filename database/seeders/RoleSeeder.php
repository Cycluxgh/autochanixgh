<?php

namespace Database\Seeders;

use App\Models\Role;
use App\RoleEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (RoleEnum::cases() as $role) {
            Role::create([
                'name' => $role->value,
                'description' => ucfirst($role->value) . ' role',
            ]);
        }
    }
}

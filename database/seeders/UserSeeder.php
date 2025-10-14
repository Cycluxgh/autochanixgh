<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\RoleEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@cyclux.com',
            'password' => Hash::make('cyclux'),
            'email_verified_at' => now(),
            'remember_token' => Str::uuid(),
            'role_id' => Role::firstWhere('name', RoleEnum::SuperAdmin->value)->id,
        ]);
    }
}

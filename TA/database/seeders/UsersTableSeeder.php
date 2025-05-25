<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        DB::table('user')->insert([
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Create cook user
        DB::table('user')->insert([
            'username' => 'cook',
            'email' => 'cook@example.com',
            'password' => Hash::make('password'),
            'role' => 'cook',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Create pastry user
        DB::table('user')->insert([
            'username' => 'pastry',
            'email' => 'pastry@example.com',
            'password' => Hash::make('password'),
            'role' => 'pastry',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}

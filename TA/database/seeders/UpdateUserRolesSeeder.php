<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateUserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds to update existing users.
     */
    public function run(): void
    {
        // Admin user - assume 'admin' exists
        DB::table('user')
            ->where('username', 'admin')
            ->update(['role' => 'admin']);

        // Find any user with username containing 'cook' and make them the cook role
        DB::table('user')
            ->where('username', 'like', '%cook%')
            ->update(['role' => 'cook']);

        // Find any user with username containing 'pastry' and make them the pastry role
        DB::table('user')
            ->where('username', 'like', '%pastry%')
            ->update(['role' => 'pastry']);
    }
}

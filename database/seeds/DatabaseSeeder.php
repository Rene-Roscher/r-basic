<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolePermissionSeeder::class);
        ($user = new \RServices\User([
            'email' => 'admin@example.com',
            'name' => 'Admin',
            'password' => \Illuminate\Support\Facades\Hash::make('123admin456'),
            'created_at' => now(),
        ]))->save();
    }
}

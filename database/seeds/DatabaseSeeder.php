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
        \App\User::create([
            'name' => 'Admin',
            'email' => 'admin@omahbarokah.com',
            'password' => Hash::make('admin'),
            'peran' => 'admin',
        ]);
        \App\User::create([
            'name' => 'Staff',
            'email' => 'staff@omahbarokah.com',
            'password' => Hash::make('staff'),
            'peran' => 'staff',
        ]);
        \App\User::create([
            'name' => 'Customer',
            'email' => 'customer@omahbarokah.com',
            'password' => Hash::make('customer'),
        ]);
    }
}

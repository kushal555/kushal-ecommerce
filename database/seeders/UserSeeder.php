<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['name' => 'Shop1', 'email' => 'shop1@devrepublic.in', 'role' => 'shop', 'password' => Hash::make('devhero'), 'language' => 'en', 'currency' => 'USD', 'username' => 'Shop1', 'is_active'=>true, ],
            ['name' => 'Shop2', 'email' => 'shop2@devrepublic.in', 'role' => 'shop', 'password' => Hash::make('devhero'), 'language' => 'en', 'currency' => 'USD', 'username' => 'Shop2', 'is_active'=>true, ],
            ['name' => 'user1', 'email' => 'user1@devrepublic.in', 'role' => 'user', 'password' => Hash::make('devhero'), 'language' => 'en', 'currency' => 'USD', 'username' => 'user1', 'is_active'=>true, ],
            ['name' => 'user2', 'email' => 'user2@devrepublic.in', 'role' => 'user', 'password' => Hash::make('devhero'), 'language' => 'en', 'currency' => 'EUR', 'username' => 'user2', 'is_active'=>true, ],
        ];
        DB::table('users')->insert($users);
    }
}

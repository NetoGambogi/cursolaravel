<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('Masterkey1'),
                'role' => 'admin',
            ],
            [
                'name' => 'User',
                'email' => 'user@gmail.com',
                'password' => bcrypt('Masterkey1'),
                'role' => 'user',
            ],
            [
                'name' => 'visitante',
                'email' => 'visitante@gmail.com',
                'password' => bcrypt('Masterkey1'),
                'role' => 'visitor',
            ],
        ];

        DB::table('users')->insert($users);
    }
}

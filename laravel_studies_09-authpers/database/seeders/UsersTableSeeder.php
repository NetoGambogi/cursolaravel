<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // add 3 users no banco de dados

        for ($i = 1; $i <= 3; $i++) {
            User::create([
                'username' => "teste$i",
                'email' => "teste$i@gmail.com",
                'password' => bcrypt('Masterkey1*'),
                'email_verified_at' => Carbon::now(),
                'active' => true,
            ]);
        }
    }
}

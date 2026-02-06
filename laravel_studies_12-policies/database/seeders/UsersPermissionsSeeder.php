<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // admin
            [
                'user_id' => 1,
                'permission' => 'create_post'
            ],
            [
                'user_id' => 1,
                'permission' => 'update_post'
            ],
            [
                'user_id' => 1,
                'permission' => 'delete_post'
            ],
            //user normal
            [
                'user_id' => 2,
                'permission' => 'create_post'
            ],
            //user visitante
            [
                'user_id' => 3,
                'permission' => 'create_post'
            ],
        ];

        foreach($permissions as $permission){
            $data = [
                'user_id' => $permission['user_id'],
                'permission' => $permission['permission'],
                'created_at' => now(),
                'updated_at' => now(),
            ];

            DB::table('users_permissions')->insert($data);
        }
    }
}

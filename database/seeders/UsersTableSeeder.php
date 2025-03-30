<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cria alguns usuários para uso em testes.
        DB::table('users')->insert([
            [
                'username' => 'admin@gmail.com',
                'password' => bcrypt('123456'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'user1@gmail.com',
                'password' => bcrypt('123456'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => now(),
            ],
            [
                'username' => 'user2@gmail.com',
                'password' => bcrypt('123456'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

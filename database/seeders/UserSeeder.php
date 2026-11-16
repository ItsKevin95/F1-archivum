<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'User1',
            'email' => 'aaa@aaa.hu',
            'password' => bcrypt('aaaaaaaa'),
        ]);
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.hu',
            'password' => bcrypt('bbbbbbbb'),
            'role' => 1,
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'nama' => 'Administrator',
            'email' => 'admin@gmail.com',
            'id_role' => 1,
            'otp_register' => 'AA6f',
            'password' => bcrypt('Admin.123'),
            'status' => 1
        ]);
    }
}

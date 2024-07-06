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
            [
                'nama' => 'Super Administrator',
                'email' => 'superadmin@gmail.com',
                'id_role' => 1,
                'otp_register' => 'AA6f',
                'password' => bcrypt('Super.123'),
                'status' => 1
            ],
            [
                'nama' => 'Ahmad Rizki',
                'email' => 'rizki@gmail.com',
                'id_role' => 2,
                'otp_register' => 'BB6f',
                'password' => bcrypt('Rizki.123'),
                'status' => 1
            ],
            [
                'nama' => 'Finance',
                'email' => 'finance@gmail.com',
                'id_role' => 3,
                'otp_register' => 'CC6f',
                'password' => bcrypt('Finance.123'),
                'status' => 1
            ],
            [
                'nama' => 'Administrator',
                'email' => 'admin@gmail.com',
                'id_role' => 4,
                'otp_register' => 'DD6f',
                'password' => bcrypt('Admin.123'),
                'status' => 1
            ],
            [
                'nama' => 'Kbih',
                'email' => 'kbih@gmail.com',
                'id_role' => 5,
                'otp_register' => 'EE6f',
                'password' => bcrypt('Kbih.123'),
                'status' => 1
            ],
        ]);
    }
}

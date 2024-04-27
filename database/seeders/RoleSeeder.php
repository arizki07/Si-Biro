<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('t_role')->insert([
            [
                'id_role' => '1',
                'nama_role' => 'Admin'
            ],
            [
                'id_role' => '2',
                'nama_role' => 'Jamaah'
            ],
            [
                'id_role' => '3',
                'nama_role' => 'Finance'
            ],
            [
                'id_role' => '4',
                'nama_role' => 'Keuangan'
            ],
            [
                'id_role' => '5',
                'nama_role' => 'Kbih'
            ]
        ]);
    }
}

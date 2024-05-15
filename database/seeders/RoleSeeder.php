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
                'role' => 'admin'
            ],
            [
                'id_role' => '2',
                'role' => 'jamaah'
            ],
            [
                'id_role' => '3',
                'role' => 'finance'
            ],
            [
                'id_role' => '4',
                'role' => 'front office'
            ],
            [
                'id_role' => '5',
                'role' => 'kbih'
            ]
        ]);
    }
}

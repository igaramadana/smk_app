<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'role_code' => 'KPS',
                'role_name' => 'Kepala Sekolah',
            ],
            [
                'role_code' => 'BND',
                'role_name' => 'Bendahara',
            ]
        ];

        DB::table('role')->insert($data);
    }
}

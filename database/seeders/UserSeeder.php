<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'email' => 'kepsek@mirafa.com',
                'password' => Hash::make('password'),
                'foto_profile' => null,
                'nama_lengkap' => 'Kepala Sekolah',
                'id_role' => 1,
            ],
            [
                'email' => 'bendahara@mirafa.com',
                'password' => Hash::make('password'),
                'foto_profile' => null,
                'nama_lengkap' => 'Bendahara Sekolah',
                'id_role' => 2,
            ]
        ];

        DB::table('users')->insert($data);
    }
}

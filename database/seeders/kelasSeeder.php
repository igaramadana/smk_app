<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class kelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama_kelas' => '1A',
            ],
            [
                'nama_kelas' => '1B',
            ],
            [
                'nama_kelas' => '1C',
            ],
            [
                'nama_kelas' => '1D',
            ],
        ];

        DB::table('kelas')->insert($data);
    }
}

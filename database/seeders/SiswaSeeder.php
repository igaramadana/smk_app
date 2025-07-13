<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nis' => '123456',
                'nama_siswa' => 'paijo',
                'id_kelas' => '1',
                'jenis_kelamin' => 'L',
                'alamat' => 'jl. mawar no. 123',
                'no_wa' => '85604657370'
            ]
        ];

        DB::table('siswa')->insert($data);
    }
}

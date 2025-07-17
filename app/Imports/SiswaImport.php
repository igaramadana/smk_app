<?php

namespace App\Imports;

use App\Models\SiswaModel;
use App\Models\KelasModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Validation\Rule;
use Throwable;

class SiswaImport implements
    ToModel,
    WithHeadingRow,
    WithValidation,
    SkipsOnError,
    SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;

    private $existingNis = [];

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Track NIS in current import
        $this->existingNis[] = $row['nis'];

        // Cari kelas berdasarkan nama, jika tidak ada buat baru
        $kelas = KelasModel::firstOrCreate([
            'nama_kelas' => $row['kelas']
        ]);

        return new SiswaModel([
            'nis'           => $row['nis'],
            'nama_siswa'    => $row['nama_siswa'],
            'id_kelas'      => $kelas->id,
            'jenis_kelamin' => strtoupper($row['jenis_kelamin']),
            'alamat'        => $row['alamat'] ?? null,
            'no_wa'         => $row['no_wa'] ?? null,
        ]);
    }

    public function rules(): array
    {
        return [
            '*.nis' => [
                'required',
                'min:4',
                // Check uniqueness in database
                Rule::unique('siswa', 'nis'),
                // Check uniqueness in current import file
                function ($attribute, $value, $fail) {
                    if (count(array_keys($this->existingNis, $value)) > 1) {
                        $fail('NIS ' . $value . ' duplikat dalam file import.');
                    }
                }
            ],
            '*.nama_siswa' => 'required|string|min:3|max:255',
            '*.kelas' => 'required|string|max:50',
            '*.jenis_kelamin' => 'required|in:L,P,l,p',
            '*.no_wa' => 'required|numeric|min:10',
            '*.alamat' => 'required',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nis.required' => 'NIS pada baris :attribute harus diisi',
            'nis.min' => 'NIS pada baris :attribute minimal 4 karakter',
            'nis.unique' => 'NIS :input pada baris :attribute sudah terdaftar di database',
            'nama_siswa.required' => 'Nama siswa pada baris :attribute harus diisi',
            'nama_siswa.min' => 'Nama siswa pada baris :attribute minimal 3 karakter',
            'kelas.required' => 'Kelas pada baris :attribute harus diisi',
            'jenis_kelamin.required' => 'Jenis kelamin pada baris :attribute harus diisi',
            'jenis_kelamin.in' => 'Jenis kelamin pada baris :attribute harus L atau P',
            'no_wa.required' => 'Nomor WA pada baris :attribute harus diisi',
            'no_wa.numeric' => 'Nomor WA pada baris :attribute harus angka',
            'no_wa.min' => 'Nomor WA pada baris :attribute minimal 10 digit',
            'alamat.required' => 'Alamat pada baris :attribute harus diisi',
        ];
    }
}

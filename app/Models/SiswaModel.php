<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaModel extends Model
{
    use HasFactory;

    protected $table = 'siswa';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nis',
        'nama_siswa',
        'id_kelas',
        'jenis_kelamin',
        'alamat',
        'no_wa'
    ];

    public function kelas()
    {
        return $this->belongsTo(KelasModel::class, 'id_kelas', 'id');
    }
}

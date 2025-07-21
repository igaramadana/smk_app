<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranModel extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id_siswa',
        'id_kategori',
        'id_petugas',
        'bulan_dibayar',
        'tanggal_pembayaran',
        'metode_pembayaran'
    ];

    public function siswa()
    {
        return $this->belongsTo(SiswaModel::class, 'id_siswa', 'id');
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriModel::class, 'id_kategori', 'id');
    }

    public function petugas()
    {
        return $this->belongsTo(UserModel::class, 'id_petugas', 'id');
    }
}

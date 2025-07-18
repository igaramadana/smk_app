<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasModel extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_kelas'
    ];
}

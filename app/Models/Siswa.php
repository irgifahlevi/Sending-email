<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_siswa',
        'nik',
        'no_kk',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'alamat',
        'kelurahan',
        'kecamatan',
        'kota',
        'kode_pos',
        'email',
        'tempat_tinggal',
        'asal_sekolah',
        'no_nisn',
        'alamat_sekolah',
        'kota_sekolah',
    ];

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'siswa_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orangtua extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_ayah',
        'no_ktp_ayah',
        'tempat_lahir_ayah',
        'tanggal_lahir_ayah',
        'pekerjaan_ayah',
        'pendidikan_terakhir_ayah',
        'no_telepon_ayah',
        'nama_ibu',
        'no_ktp_ibu',
        'tempat_lahir_ibu',
        'tanggal_lahir_ibu',
        'pekerjaan_ibu',
        'pendidikan_terakhir_ibu',
        'no_telepon_ibu'
    ];

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'orangtua_id', 'id');
    }
}

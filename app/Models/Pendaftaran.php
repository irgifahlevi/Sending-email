<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;
    protected $fillable = [
        'no_pendaftaran',
        'siswa_id',
        'orangtua_id',
        'is_bayar',
        'gelombang_id'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }

    public function orangTua()
    {
        return $this->belongsTo(Orangtua::class, 'gelombang_id', 'id');
    }

    public function gelombang()
    {
        return $this->belongsTo(Gelombang::class, 'orangtua_id', 'id');
    }
}

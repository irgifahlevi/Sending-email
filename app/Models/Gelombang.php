<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gelombang extends Model
{
    use HasFactory;
    protected $fillable = [
        'gelombang',
        'administrasi_pendaftaran'
    ];

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'gelombang_id', 'id');
    }
}

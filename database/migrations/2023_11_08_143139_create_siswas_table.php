<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_siswa');
            $table->unsignedBigInteger('nik')->length(16);
            $table->unsignedBigInteger('no_kk')->length(16);
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('agama');
            $table->string('alamat', 500);
            $table->string('kelurahan');
            $table->string('kecamatan');
            $table->string('kota');
            $table->integer('kode_pos');
            $table->string('email');
            $table->string('tempat_tinggal');
            $table->string('asal_sekolah');
            $table->integer('no_nisn');
            $table->string('alamat_sekolah', 500);
            $table->string('kota_sekolah');
            $table->integer('row_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};

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
        Schema::create('orangtuas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ayah')->nullable();
            $table->string('no_ktp_ayah')->nullable();
            $table->string('tempat_lahir_ayah')->nullable();
            $table->string('tanggal_lahir_ayah')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('pendidikan_terakhir_ayah')->nullable();
            $table->string('no_telepon_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('no_ktp_ibu')->nullable();
            $table->string('tempat_lahir_ibu')->nullable();
            $table->string('tanggal_lahir_ibu')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('pendidikan_terakhir_ibu')->nullable();
            $table->string('no_telepon_ibu')->nullable();
            $table->integer('row_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orangtuas');
    }
};

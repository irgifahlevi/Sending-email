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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->string('no_pendaftaran');
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('orangtua_id');
            $table->unsignedBigInteger('gelombang_id');
            $table->integer('is_bayar');
            $table->integer('row_status');
            $table->timestamps();

            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
            $table->foreign('orangtua_id')->references('id')->on('orangtuas')->onDelete('cascade');
            $table->foreign('gelombang_id')->references('id')->on('gelombangs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};

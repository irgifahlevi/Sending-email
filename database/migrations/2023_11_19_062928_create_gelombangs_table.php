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
        Schema::create('gelombangs', function (Blueprint $table) {
            $table->id();
            $table->enum('gelombang', ['Satu', 'Dua', 'Tiga'])->nullable()->default('Satu');
            $table->integer('administrasi_pendaftaran');
            $table->integer('row_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gelombangs');
    }
};

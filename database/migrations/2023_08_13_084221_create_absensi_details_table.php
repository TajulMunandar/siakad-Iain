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
        Schema::create('absensi_details', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('pertemuan');
            $table->foreignId('id_absensi')->constrained('absensis')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('id_mahasiswa')->constrained('mahasiswas')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('id_status')->constrained('status_absensis')->onDelete('restrict')->onUpdate('cascade');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi_details');
    }
};

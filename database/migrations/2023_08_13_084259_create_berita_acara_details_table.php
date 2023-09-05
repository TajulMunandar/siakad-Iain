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
        Schema::create('berita_acara_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_berita_acara')->constrained('berita_acaras')->onDelete('restrict')->onUpdate('cascade');
            $table->date('tanggal');
            $table->tinyInteger('pertemuan');
            $table->string('materi');
            $table->tinyInteger('jumlah_mahasiswa');
            $table->string('bukti_pelaksanaan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita_acara_details');
    }
};

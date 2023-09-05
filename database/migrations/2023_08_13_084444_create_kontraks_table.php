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
        Schema::create('kontraks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kelas')->constrained('kelas')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('id_dosen')->constrained('dosens')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('id_matakuliah')->constrained('mata_kuliahs')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('id_prodi')->constrained('prodis')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('id_fakultas')->constrained('fakultas')->onDelete('restrict')->onUpdate('cascade');
            $table->enum('semester', ['GANJIL', 'GENAP']);
            $table->string('tahun_akademik');
            $table->tinyInteger('uas');
            $table->tinyInteger('uts');
            $table->tinyInteger('tugas');
            $table->tinyInteger('kuis');
            $table->text('ket');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontraks');
    }
};

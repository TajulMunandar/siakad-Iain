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
        Schema::create('surveis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_dosen')->constrained('dosens')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('id_matakuliah')->constrained('mata_kuliahs')->onDelete('restrict')->onUpdate('cascade');
            $table->string('semester');
            $table->string('tahun_akademik');
            $table->string('kendala');
            $table->string('saran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surveis');
    }
};

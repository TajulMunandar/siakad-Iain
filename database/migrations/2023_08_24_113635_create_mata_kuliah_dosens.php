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
        Schema::create('mata_kuliah_dosens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_matakuliah')->constrained('mata_kuliahs')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('id_dosen')->constrained('dosens')->onDelete('restrict')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matakuliah_dosens');
    }
};

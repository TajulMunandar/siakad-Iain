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
        Schema::create('survei_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_survei')->constrained('surveis')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('id_soal')->constrained('soal_surveis')->onDelete('restrict')->onUpdate('cascade');
            $table->tinyInteger('skala_jawaban');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survei_details');
    }
};

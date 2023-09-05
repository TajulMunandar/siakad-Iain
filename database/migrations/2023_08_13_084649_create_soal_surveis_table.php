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
        Schema::create('soal_surveis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_indikator')->constrained('indikator_surveis')->onDelete('restrict')->onUpdate('cascade');
            $table->string('soal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soal_surveis');
    }
};

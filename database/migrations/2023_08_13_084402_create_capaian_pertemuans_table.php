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
        Schema::create('capaian_pertemuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_rps')->constrained('rps')->onDelete('restrict')->onUpdate('cascade');
            $table->text('sub_cpmk');
            $table->string('materi');
            $table->string('metode');
            $table->integer('waktu');
            $table->text('pengalaman');
            $table->string('indikator');
            $table->integer('nilai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capaian_pertemuans');
    }
};

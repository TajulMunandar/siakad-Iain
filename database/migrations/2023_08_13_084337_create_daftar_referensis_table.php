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
        Schema::create('daftar_referensis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_rps')->constrained('rps')->onDelete('restrict')->onUpdate('cascade');
            $table->string('utama');
            $table->string('penelitian');
            $table->string('pengabdian');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_referensis');
    }
};

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
        Schema::create('cpls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_capaian')->constrained('capaians')->onDelete('restrict')->onUpdate('cascade');
            $table->text('cpl_sikap')->nullable();
            $table->text('cpl_k_umum')->nullable();
            $table->text('cpl_k_khusus')->nullable();
            $table->text('cpl_pengetahuan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cpls');
    }
};

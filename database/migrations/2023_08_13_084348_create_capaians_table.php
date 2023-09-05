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
        Schema::create('capaians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_rps')->constrained('rps')->onDelete('restrict')->onUpdate('cascade');
            $table->text('desc');
            $table->tinyInteger('uas');
            $table->tinyInteger('uts');
            $table->tinyInteger('tugas');
            $table->tinyInteger('kuis');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capaians');
    }
};

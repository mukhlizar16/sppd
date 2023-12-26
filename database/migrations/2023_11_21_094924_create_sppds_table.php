<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sppds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')
                ->index()
                ->constrained('kepegawaian')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('jenis_tugas_id')->constrained('jenis_tugas')->onUpdate('cascade')->onDelete('restrict');
            $table->integer('total_biaya')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sppds');
    }
};

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
        Schema::create('sppd', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_tugas_id')
                ->index()
                ->constrained('jenis_tugas')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('nomor_sp2d');
            $table->string('kegiatan');
            $table->integer('total_biaya')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sppd');
    }
};

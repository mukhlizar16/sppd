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
        Schema::create('sppd_pegawai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sppd_id')
                ->index()
                ->constrained('sppd')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('pegawai_id')
                ->index()
                ->constrained('kepegawaian')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sppd_pegawai');
    }
};

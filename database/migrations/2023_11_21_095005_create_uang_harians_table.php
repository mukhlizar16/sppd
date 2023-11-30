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
        Schema::create('uang_harians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sppd_id')->constrained('sppds')->onUpdate('cascade')->onDelete('restrict');
            $table->integer('harian');
            $table->integer('total_harian');
            $table->integer('konsumsi');
            $table->integer('total_konsumsi');
            $table->integer('transportasi');
            $table->integer('total_transportasi');
            $table->integer('representasi');
            $table->integer('total_representasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uang_harians');
    }
};

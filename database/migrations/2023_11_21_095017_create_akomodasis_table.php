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
        Schema::create('akomodasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sppd_id')
                ->index()
                ->constrained('sppd')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('nama_hotel');
            $table->date('check_in');
            $table->date('check_out');
            $table->string('nomor_invoice');
            $table->string('nomor_kamar');
            $table->tinyInteger('lama_inap');
            $table->string('nama_kwitansi');
            $table->integer('harga');
            $table->integer('harga_diskon');
            $table->integer('bbm');
            $table->string('dari');
            $table->string('ke');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akomodasi');
    }
};

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
        Schema::create('akomodasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sppd_id')->constrained('sppds')->onUpdate('cascade')->onDelete('restrict');
            $table->string('name_hotel');
            $table->date('tgl_masuk');
            $table->date('tgl_keluar');
            $table->string('no_invoice');
            $table->string('no_kamar');
            $table->tinyInteger('lama_inap');
            $table->string('nama_kwitansi');
            $table->integer('harga_permalam');
            $table->integer('harga_permalam2');
            $table->integer('total_uang');
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
        Schema::dropIfExists('akomodasis');
    }
};

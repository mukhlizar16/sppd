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
        Schema::create('surat_tugas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sppd_id')->constrained('sppds')->onUpdate('cascade')->onDelete('restrict');
            $table->integer('nomor_sp2d');
            $table->foreignId('pegawai_id')->constrained('kepegawaian')->onUpdate('cascade')->onDelete('restrict');
            $table->integer('nomor_st');
            $table->integer('nomor_spd');
            $table->string('kegiatan');
            $table->string('dari');
            $table->string('tujuan');
            $table->string('nama_kegiatan');
            $table->tinyInteger('lama_tugas');
            $table->date('tanggal');
            $table->date('tanggal_berangkat');
            $table->date('tanggal_kembali');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_tugas');
    }
};

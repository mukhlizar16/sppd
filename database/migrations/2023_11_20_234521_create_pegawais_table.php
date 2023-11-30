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
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->foreignId('jenis_asn_id')->constrained('asns')->onUpdate('cascade')->onDelete('restrict');
            $table->string('gelar_depan')->nullable();
            $table->string('gelar_belakang')->nullable();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('nip_lama')->nullable();
            $table->string('nip_baru');
            $table->string('universitas')->nullable();
            $table->string('jurusan');
            $table->string('tingkat_ijazah')->nullable();
            $table->year('tahun_lulus')->nullable();
            $table->foreignId('golongan_id')->constrained('golongans')->onUpdate('cascade')->onDelete('restrict');
            $table->date('tmt_cpns');
            $table->date('tmt_pangkat_terakhir');
            $table->string('jabatan');
            $table->date('tmt_jabatan');
            $table->integer('masa_kerja_tahun');
            $table->integer('masa_kerja_bulan')->nullable();
            $table->string('unit_kerja');
            $table->string('instansi_induk');
            $table->string('alamat');
            $table->string('telp');
            $table->date('rencana_naik_pangkat');
            $table->date('rencana_naik_gaji');
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};

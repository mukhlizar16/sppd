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
            $table->string('nip');
            $table->foreignId('golongan_id')->constrained('golongans')->onUpdate('cascade')->onDelete('restrict');
            $table->string('jabatan');
            $table->string('instansi');
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

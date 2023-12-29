<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Sppd extends Model
{
    use HasFactory;

    protected $fillable = ['pegawai_id', 'jenis_tugas_id', 'total_biaya'];

    public function jenisTugas()
    {
        return $this->belongsTo(JenisTugas::class, 'jenis_tugas_id');
    }

    public function suratTugas(): HasOne
    {
        return $this->hasOne(SuratTugas::class, 'sppd_id');
    }

    public function totalPergi(): HasOne
    {
        return $this->hasOne(TotalPergi::class, 'sppd_id');
    }

    public function totalPulang(): HasOne
    {
        return $this->hasOne(TotalPulang::class, 'sppd_id');
    }

    public function uangHarian(): HasOne
    {
        return $this->hasOne(UangHarian::class, 'sppd_id');
    }

    public function akomodasi(): HasOne
    {
        return $this->hasOne(Akomodasi::class, 'sppd_id');
    }

    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
}

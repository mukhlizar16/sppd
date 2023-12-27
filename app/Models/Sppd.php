<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sppd extends Model
{
    use HasFactory;

    protected $fillable = ['pegawai_id', 'jenis_tugas_id', 'total_biaya'];

    public function JenisTugas()
    {
        return $this->belongsTo(JenisTugas::class, 'jenis_tugas_id');
    }

    public function SuratTugas()
    {
        return $this->hasMany(SuratTugas::class, 'sppd_id');
    }

    public function TotalPergi()
    {
        return $this->hasMany(TotalPergi::class, 'sppd_id');
    }

    public function TotalPulang()
    {
        return $this->hasMany(TotalPulang::class, 'sppd_id');
    }

    public function UangHarian()
    {
        return $this->hasMany(UangHarian::class, 'sppd_id');
    }

    public function Akomodasi()
    {
        return $this->hasMany(Akomodasi::class, 'sppd_id');
    }

    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
}

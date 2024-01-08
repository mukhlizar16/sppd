<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Sppd extends Model
{
    use HasFactory;

    protected $table = 'sppd';
    protected $fillable = ['jenis_tugas_id', 'nomor_sp2d', 'kegiatan', 'total_biaya'];

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

    public function pegawais(): BelongsToMany
    {
        return $this->belongsToMany(Pegawai::class, 'sppd_pegawai', 'sppd_id', 'pegawai_id');
    }
}

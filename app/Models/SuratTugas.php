<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratTugas extends Model
{
    use HasFactory;

    protected $table = 'surat_tugas';
    protected $fillable = ['sppd_id', 'nomor_spd', 'nomor', 'kegiatan', 'lama_tugas', 'tanggal', 'tanggal_berangkat', 'tanggal_kembali'];

    public function Sppd()
    {
        return $this->belongsTo(Sppd::class, 'sppd_id');
    }

    public function Pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SppdPegawai extends Model
{
    use HasFactory;

    protected $table = 'sppd_pegawai';

    protected $fillable = ['sppd_id', 'pegawai_id'];

    public function Sppd()
    {
        return $this->belongsTo(Sppd::class, 'sppd_id');
    }

    public function Pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
}

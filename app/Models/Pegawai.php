<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pegawai extends Model
{
    protected $table = 'kepegawaian';

    protected $fillable = ['nama'];

    use HasFactory;

    protected $appends = [
        'nama_lengkap',
    ];

    public function SuratTugas()
    {
        return $this->hasMany(SuratTugas::class, 'pegawai_id');
    }

    public function namaLengkap(): Attribute
    {
        return Attribute::make(
            get: fn($value) => ($this->attributes['gelar_depan'] != null ?
                $this->attributes['gelar_depan'] . ' '
                : '') . $this->attributes['nama'] . ($this->attributes['gelar_belakang'] != null ?
                ', ' . $this->attributes['gelar_belakang']
                : ''),
        );
    }

    public function Golongan(): BelongsTo
    {
        return $this->belongsTo(Golongan::class, 'golongan_id');
    }

    public function jenisAsn(): BelongsTo
    {
        return $this->belongsTo(Asn::class, 'jenis_asn_id');
    }

    public function sppds(): BelongsToMany
    {
        return $this->belongsToMany(Sppd::class, 'sppd_pegawai', 'pegawai_id', 'sppd_id');
    }
}

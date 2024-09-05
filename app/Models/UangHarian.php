<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UangHarian extends Model
{
    use HasFactory;

    protected $table = 'uang_harian';

    protected $fillable = ['sppd_id', 'harian', 'total_harian', 'konsumsi', 'total_konsumsi', 'transportasi', 'total_transportasi', 'representasi'];

    public function Sppd()
    {
        return $this->belongsTo(Sppd::class, 'sppd_id');
    }
}

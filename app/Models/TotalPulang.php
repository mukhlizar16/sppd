<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TotalPulang extends Model
{
    use HasFactory;
    protected $table = 'total_pulang';
    protected $guarded = ['id'];

    public function Sppd()
    {
        return $this->belongsTo(Sppd::class, 'sppd_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akomodasi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'akomodasi';

    public function Sppd()
    {
        return $this->belongsTo(Sppd::class, 'sppd_id');
    }
}

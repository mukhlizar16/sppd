<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'golongans';

    public function Pegawai()
    {
        return $this->hasMany(Pegawai::class, 'golongan_id');
    }
}

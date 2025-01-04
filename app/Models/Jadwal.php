<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'permohonan_id',
        'petugas_id',
        'jadwal',
        'location',
        'status',
    ];

    public function permohonan() {
        return $this->belongsTo(Permohonan::class);
    }

    public function petugas() {
        return $this->belongsTo(User::class);
    }

    public function laporan() {
        return $this->hasOne(Laporan::class);
    }
}

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
        'petugas_2_id',
        'jadwal',
        'location',
        'status',
    ];

    public function permohonan() {
        return $this->belongsTo(Permohonan::class);
    }

    public function petugas() {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    public function petugas2() {
        return $this->belongsTo(User::class, 'petugas_2_id');
    }

    public function laporan() {
        return $this->hasOne(Laporan::class);
    }
}

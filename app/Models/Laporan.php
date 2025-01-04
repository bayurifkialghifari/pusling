<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Laporan extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'jadwal_id',
        'jumlah_pengunjung_laki',
        'jumlah_pengunjung_perempuan',
        'masukan',
        'kendala',
    ];

    public function jadwal() {
        return $this->belongsTo(Jadwal::class);
    }
}

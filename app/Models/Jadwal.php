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
}

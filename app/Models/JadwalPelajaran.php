<?php

namespace App\Models;

use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Mengajar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPelajaran extends Model
{
    use HasFactory;

    protected $table = 'jadwal_pelajaran';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_kelas',
        'id_mapel',
        'id_mengajar',
        'hari',
        'jam_pelajaran',
        'semester',
    ];

    public function kelas(): belongTo
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function mataPelajaran(): belongTo
    {
        return $this->belongsTo(MataPelajaran::class, 'id_mapel');
    }

    public function mengajar(): belongTo
    {
        return $this->belongsTo(Mengajar::class, 'id_mengajar');
    }
}

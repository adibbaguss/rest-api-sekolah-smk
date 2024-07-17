<?php

namespace App\Models;

use App\Models\Guru;
use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use Illuminate\Database\Eloquent\Model;

class Mengajar extends Model
{
    protected $table = 'mengajar';

    protected $fillable = [
        'kode_mengajar',
        'id_guru',
        'id_kelas',
        'id_mapel',
        'semester',
    ];

    /**
     * Relasi ke model Guru
     */
    public function guru(): belongTo
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }

    /**
     * Relasi ke model Kelas
     */
    public function kelas(): hasMany
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    /**
     * Relasi ke model JadwalPelajaran
     */
    public function jadwalPelajaran(): hasMany
    {
        return $this->hasMany(JadwalPelajaran::class, 'id');
    }

}

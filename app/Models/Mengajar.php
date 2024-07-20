<?php

namespace App\Models;

use App\Models\Guru;
use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
    public function guru(): BelongsTo
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id');
    }

    /**
     * Relasi ke model Kelas
     */
    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id');
    }

    /**
     * Relasi ke model Kelas
     */
    public function mataPelajaran(): BelongsTo
    {
        return $this->belongsTo(MataPelajaran::class, 'id_mapel', 'id');
    }

    /**
     * Relasi ke model JadwalPelajaran
     */
    public function jadwalPelajaran(): HasMany
    {
        return $this->hasMany(JadwalPelajaran::class, 'id_mengajar', 'id');
    }

}

<?php

namespace App\Models;

use App\Models\MataPelajaran;
use App\Models\Mengajar;
use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Nilai extends Model
{
    use HasFactory;

    protected $table = 'nilai';

    protected $fillable = [
        'id_siswa',
        'id_mapel',
        'nilai_angka',
    ];

    /**
     * Relasi ke model Siswa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id');
    }

    /**
     * Relasi ke model MataPelajaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mataPelajaran(): BelongsTo
    {
        return $this->belongsTo(MataPelajaran::class, 'id_mapel', 'id');
    }

    /**
     * Relasi ke model Mengajar
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mengajar(): BelongsTo
    {
        return $this->belongsTo(Mengajar::class, 'id_mapel', 'id');
    }
}

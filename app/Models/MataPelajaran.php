<?php

namespace App\Models;

use App\Models\JadwalPelajaran;
use App\Models\Mengajar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MataPelajaran extends Model
{
    use HasFactory;

    protected $table = 'mata_pelajaran';

    protected $fillable = [
        'kode_mapel',
        'nama_mapel',
    ];

    protected $primaryKey = 'id';

    // relasi
    /**
     * Get all of the jadwalPelajaran for the MataPelajaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jadwalPelajaran(): HasMany
    {
        return $this->hasMany(JadwalPelajaran::class, 'id_mapel', 'id');
    }

/**
 * Get all of the mengajar for the MataPelajaran
 *
 * @return \Illuminate\Database\Eloquent\Relations\HasMany
 */
    public function mengajar(): HasMany
    {
        return $this->hasMany(Mengajar::class, 'id_mapel');
    }

}

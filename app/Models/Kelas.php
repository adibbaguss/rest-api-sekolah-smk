<?php

namespace App\Models;

use App\Models\JadwalPelajaran;
use App\Models\Mengajar;
use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'nama_kelas',
        'tahun_ajaran',
    ];

    protected $primaryKey = 'id';

    public function jadwalPelajaran(): HasMany
    {
        return $this->hasMany(JadwalPelajaran::class, 'id_kelas', 'id');
    }

    public function mengajar(): HasMany
    {
        return $this->hasMany(Mengajar::class, 'id_kelas', 'id');
    }

    public function siswa(): HasMany
    {
        return $this->hasMany(Siswa::class, 'id_kelas', 'id');
    }
}

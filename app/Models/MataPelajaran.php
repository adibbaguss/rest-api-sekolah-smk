<?php

namespace App\Models;

use App\Models\Guru;
use App\Models\JadwalPelajaran;
use App\Models\Mengajar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    public function jadwalPelajaran(): hasMany
    {
        return $this->hasMany(JadwalPelajaran::class, 'id');
    }

    public function guru(): hasMany
    {
        return $this->hasManys(Guru::class, 'id');
    }

    public function mengajar(): hasMany
    {
        return $this->hasMany(Mengajar::class, 'id');
    }

}

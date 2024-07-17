<?php

namespace App\Models;

use App\Models\JadwalPelajaran;
use App\Models\Mengajar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->hasMany(JadwalPelajaran::class, 'id');
    }

    public function mengajar(): hasMany
    {
        return $this->hasMany(Mengajar::class, 'id');
    }
}

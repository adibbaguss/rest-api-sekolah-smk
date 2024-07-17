<?php

namespace App\Models;

use App\Models\Jurusan;
use App\Models\Nilai;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    // menentukan tabel yang digunakan pada database
    protected $table = 'siswa';

    // menentukan tabel yang bisa diisi
    protected $fillable = [
        'nisn',
        'nama_lengkap',
        'jenis_kelamin',
        'tanggal_lahir',
        'tempat_lahir',
        'alamat',
        'nomor_telepon',
        'email',
        'id_jurusan',
        'status_aktif',
        'tahun_masuk',
        'tahun_lulus',
    ];

    protected $primayKey = 'id';

    // relasi
    public function jurusan(): BelongTo
    {
        return $this->belongTo(Jurusan::class, 'id_jurusan');
    }

    public function nilai(): hasMany
    {
        return $this->hasMany(Nilai::class, 'id');
    }

}

<?php

namespace App\Models;

use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Nilai;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'id_kelas',
        'status_aktif',
        'tahun_masuk',
        'tahun_lulus',
    ];

    protected $primayKey = 'id';

    /**
     * Get the jurusan that owns the Siswa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jurusan(): BelongsTo
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan', 'id');
    }

    /**
     * Get the kelas that owns the Siswa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id');
    }

    /**
     * Get the nilai that owns the Siswa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function nilai(): HasMany
    {
        return $this->hasMany(Nilai::class, 'id_siswa', 'id');
    }

}

<?php

namespace App\Models;

use App\Models\Mengajar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'guru';

    protected $fillable = [
        'nip',
        'nama_lengkap',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'nomor_telepon',
        'email',
    ];

    protected $primaryKey = 'id';

    // relasi
    /**
     * Get all of the mengajar for the Guru
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mengajar(): HasMany
    {
        return $this->hasMany(Mengajar::class, 'id_guru', 'id');
    }

}

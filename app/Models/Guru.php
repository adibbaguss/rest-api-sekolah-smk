<?php

namespace App\Models;

use App\Models\Mengajar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    public function mengajar(): hasMany
    {
        return $this->hasMany(Mengajar::class, 'id');
    }
}

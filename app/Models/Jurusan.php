<?php

namespace App\Models;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusan';

    protected $fillable = [
        'kode_jurusan',
        'nama_jurusan',
    ];

    protected $primaryKey = 'id';

    /**
     * Get all of the comments for the Jurusan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function siswa(): HasMany
    {
        return $this->hasMany(Siswa::class, 'id_jurusan', 'id');
    }

}

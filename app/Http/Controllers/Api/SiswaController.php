<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SiswaResource;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $siswa = Siswa::all();
        return new SiswaResource(true, 'List Data Siswa', $siswa);
    }

    /**
     * store
     *
     * @return void
     */
    public function store(Request $request)
    {
        // define validation rules
        $validator = Validator::make($request->all(), [
            'nisn' => 'required',
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'tempat_lahir' => 'required',
            'alamat' => 'required',
            'nomor_telepon' => 'required',
            'email' => 'required',
            'id_jurusan' => 'required',
            'status_aktif' => 'required',
            'tahun_masuk' => 'required',
            'tahun_lulus' => 'nullable',
        ]);

        // check, if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // create siswa
        $siswa = Siswa::create([
            'nisn' => $request->nisn,
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tempat_lahir' => $request->tempat_lahir,
            'alamat' => $request->alamat,
            'nomor_telepon' => $request->nomor_telepon,
            'email' => $request->email,
            'id_jurusan' => $request->id_jurusan,
            'status_aktif' => $request->status_aktif,
            'tahun_masuk' => $request->tahun_masuk,
            'tahun_lulus' => $request->tahun_lulus,
        ]);

        return new SiswaResource(true, 'Data Siswa Berhasil Ditambahkan', $siswa);
    }

    /**
     * show
     *
     * @param mixed $id
     * @return void
     */
    public function show($id)
    {
        $siswa = Siswa::find($id);

        return new SiswaResource(true, 'Detail Data siswa!', $siswa);
    }

    /**
     * Update
     *
     * @param Request $request
     * @param mixed $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        // define validation rules
        $validator = Validator::make($request->all(), [
            'nisn' => 'required',
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'tempat_lahir' => 'required',
            'alamat' => 'required',
            'nomor_telepon' => 'required',
            'email' => 'required',
            'id_jurusan' => 'required',
            'status_aktif' => 'required',
            'tahun_masuk' => 'required',
            'tahun_lulus' => 'nullable',
        ]);

        // check, if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $siswa = Siswa::find($id);

        // create siswa
        $siswa->update([
            'nisn' => $request->nisn,
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tempat_lahir' => $request->tempat_lahir,
            'alamat' => $request->alamat,
            'nomor_telepon' => $request->nomor_telepon,
            'email' => $request->email,
            'id_jurusan' => $request->id_jurusan,
            'status_aktif' => $request->status_aktif,
            'tahun_masuk' => $request->tahun_masuk,
            'tahun_lulus' => $request->tahun_lulus,
        ]);

        return new SiswaResource(true, 'Data Siswa Berhasil Diperbarui!', $siswa);
    }

    /**
     * delete/destroy
     *
     * @param mixed $id
     * @return void
     */
    public function destroy($id)
    {
        //find post by ID
        $siswa = Siswa::find($id);

        $siswa->delete();

        return new SiswaResource(true, 'Data Siswa Berhasil Dihapus!', null);

    }

    /**
     * getJadwalBySiswa
     *
     * @param mixed $id
     * @return void
     */
    public function getJadwalBySiswa($id)
    {
        // Mengambil data siswa beserta jadwal pelajaran melalui relasi kelas
        $siswa = Siswa::with('kelas.jadwalPelajaran')->find($id);

        // Memeriksa apakah data siswa ditemukan
        if (!$siswa) {
            return response()->json(['message' => 'Data Siswa not found'], 404);
        }

        $jadwalPelajaran = $siswa->kelas->jadwalPelajaran->map(function ($jadwal) {
            return [
                'hari' => $jadwal->hari,
                'jam_pelajaran' => $jadwal->jam_pelajaran,
                'semester' => $jadwal->semester,
            ];
        });

        $data = [
            'id' => $siswa->id,
            'nisn' => $siswa->nisn,
            'nama_siswa' => $siswa->nama_lengkap,
            'jadwal_pelajaran' => $jadwalPelajaran,
        ];

        // Mengembalikan response menggunakan SiswaResource
        return new SiswaResource(true, 'Data Jadwal Siswa!', $data);
    }

    /**
     * getNilaiBySiswa
     *
     * @param mixed $id
     * @return void
     */
    public function getNilaiBySiswa($id)
    {
        // Mengambil data siswa beserta relasi nilai, mataPelajaran, jadwalPelajaran, dan kelas
        $siswa = Siswa::with(['nilai.mataPelajaran.jadwalPelajaran.kelas'])->find($id);

        // Memeriksa apakah data siswa ditemukan
        if (!$siswa) {
            return response()->json(['message' => 'Data Siswa not found'], 404);
        }

        // Menyusun data nilai berdasarkan tahun ajaran dan semester
        $nilaiGrouped = $siswa->nilai->groupBy(function ($nilai) {
            return $nilai->mataPelajaran->jadwalPelajaran->first()->kelas->tahun_ajaran ?? 'unknown';
        })->map(function ($groupedByYear) {
            return $groupedByYear->groupBy(function ($nilai) {
                return $nilai->mataPelajaran->jadwalPelajaran->first()->semester ?? 'unknown';
            })->map(function ($groupedBySemester) {
                return $groupedBySemester->map(function ($nilai) {
                    return [
                        'kode_mapel' => $nilai->mataPelajaran->kode_mapel,
                        'nama_mapel' => $nilai->mataPelajaran->nama_mapel,
                        'nilai' => $nilai->nilai_angka,
                    ];
                });
            });
        });

        // Menyusun data untuk respon
        $data = [
            'id' => $siswa->id,
            'nama' => $siswa->nama_lengkap,
            'nilai' => $nilaiGrouped,
        ];

        // Mengembalikan response menggunakan SiswaResource
        return new SiswaResource(true, 'Data Nilai Siswa!', $data);
    }

}

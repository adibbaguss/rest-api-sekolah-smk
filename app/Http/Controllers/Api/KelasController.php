<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\KelasResource;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $kelas = Kelas::all();
        return new KelasResource(true, 'List Data Kelas!', $kelas);
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
            'nama_kelas' => 'required',
            'tahun_ajaran' => 'required',
        ]);

        // check, if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // create Kelas
        $kelas = Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'tahun_ajaran' => $request->tahun_ajaran,

        ]);

        return new KelasResource(true, 'Data Kelas Berhasil Ditambahkan', $kelas);
    }

    /**
     * show
     *
     * @param mixed $id
     * @return void
     */
    public function show($id)
    {
        $kelas = Kelas::find($id);

        return new KelasResource(true, 'Detail Data Kelas!', $kelas);
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
            'nama_kelas' => 'required',
            'tahun_ajaran' => 'required',
        ]);

        // check, if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $kelas = Kelas::find($id);

        // create Kelas
        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
            'tahun_ajaran' => $request->tahun_ajaran,
        ]);

        return new KelasResource(true, 'Data Kelas Berhasil Diperbarui!', $kelas);
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
        $kelas = Kelas::find($id);

        $kelas->delete();

        return new KelasResource(true, 'Data Kelas Berhasil Dihapus!', null);

    }

/**
 * get siswa by id kelas
 *
 * @param mixed $id
 * @return void
 */
    public function getSiswaByKelas($id)
    {

        $kelas = Kelas::with('siswa')->find($id);

        if (!$kelas) {
            return response()->json(['message' => 'Data Siswa not found'], 404);
        }

        // Mengembalikan response menggunakan GuruResource
        return new KelasResource(true, 'Data Kelas dan Siswa!', $kelas);
    }

    public function getNilaiByKelasAndMataPelajaran($kelasId, $mataPelajaranId)
    {
        // Mengambil data kelas beserta siswa dan nilai mereka untuk mata pelajaran tertentu
        $kelas = Kelas::with(['siswa' => function ($query) use ($mataPelajaranId) {
            $query->with(['nilai' => function ($query) use ($mataPelajaranId) {
                $query->where('id_mapel', $mataPelajaranId);
            }]);
        }])->find($kelasId);

        // Memeriksa apakah data kelas ditemukan
        if (!$kelas) {
            return response()->json(['message' => 'Data Kelas not found'], 404);
        }

        // Menyusun data nilai untuk respon
        $data = [
            'nama_kelas' => $kelas->nama_kelas,
            'tahun_ajaran' => $kelas->tahun_ajaran,
            'mata_pelajaran' => null,
            'siswa' => [],
        ];

        // Looping through each siswa in the kelas
        foreach ($kelas->siswa as $siswa) {
            foreach ($siswa->nilai as $nilai) {
                // Set mata pelajaran data if not already set
                if ($data['mata_pelajaran'] === null) {
                    $data['mata_pelajaran'] = [
                        'kode_mapel' => $nilai->mataPelajaran->kode_mapel,
                        'nama_mapel' => $nilai->mataPelajaran->nama_mapel,
                    ];
                }

                // Add siswa data
                $data['siswa'][] = [
                    'id_siswa' => $siswa->id,
                    'nisn' => $siswa->nisn,
                    'nama_siswa' => $siswa->nama_lengkap,
                    'nilai' => $nilai->nilai_angka,
                ];
            }
        }

        // Mengembalikan response menggunakan resource atau JSON
        return response()->json([
            'success' => true,
            'message' => 'Data Nilai Siswa untuk Mata Pelajaran Tertentu!',
            'data' => $data,
        ]);
    }

}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GuruResource;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GuruController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $guru = Guru::all();
        return new GuruResource(true, 'List Data Guru!', $guru);
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

            'nip' => 'required',
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'nomor_telepon' => 'required',
            'email' => 'required',
        ]);

        // check, if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // create Guru
        $guru = Guru::create([
            'nip' => $request->nip,
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'nomor_telepon' => $request->nomor_telepon,
            'email' => $request->email,

        ]);

        return new GuruResource(true, 'Data Guru Berhasil Ditambahkan', $guru);
    }

    /**
     * show
     *
     * @param mixed $id
     * @return void
     */
    public function show($id)
    {
        $guru = Guru::find($id);

        return new GuruResource(true, 'Detail Data Guru!', $guru);
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

            'nip' => 'required',
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'nomor_telepon' => 'required',
            'email' => 'required',
        ]);

        // check, if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $guru = Guru::find($id);

        // create Guru
        $guru->update([
            'nip' => $request->nip,
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'nomor_telepon' => $request->nomor_telepon,
            'email' => $request->email,
        ]);

        return new GuruResource(true, 'Data Guru Berhasil Diperbarui!', $guru);
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
        $guru = Guru::find($id);

        $guru->delete();

        return new GuruResource(true, 'Data Guru Berhasil Dihapus!', null);

    }

    /**
     * getMengajarByGuru
     *
     * @param mixed $id
     * @return void
     */
    public function getMengajarByGuru($id)
    {
        // Menggunakan Eloquent dengan eager loading untuk mengambil data guru beserta relasi mengajar
        $guru = Guru::with(['mengajar.mataPelajaran', 'mengajar.kelas', 'mengajar.jadwalPelajaran'])->find($id);

        // Memeriksa apakah data guru ditemukan
        if (!$guru) {
            return response()->json(['message' => 'Guru not found'], 404);
        }

        // Menyusun data jadwal pelajaran untuk respon
        $jadwalGuru = $guru->mengajar->flatMap(function ($mengajarItem) {
            return $mengajarItem->jadwalPelajaran->map(function ($jadwal) use ($mengajarItem) {
                return [
                    'hari' => $jadwal->hari,
                    'jam_pelajaran' => $jadwal->jam_pelajaran,
                    'semester' => $jadwal->semester,
                    'pelajaran' => [
                        'kode_mapel' => $mengajarItem->mataPelajaran->kode_mapel,
                        'nama_mapel' => $mengajarItem->mataPelajaran->nama_mapel,
                        'nama_kelas' => $mengajarItem->kelas->nama_kelas,
                        'tahun_ajaran' => $mengajarItem->kelas->tahun_ajaran,
                    ],
                ];
            });
        })
            ->sortBy(function ($item) {
                return $item['semester'];
            })->values();

        // Menyusun data guru beserta jadwal pelajaran
        $data = [
            'id' => $guru->id,
            'nip' => $guru->nip,
            'nama_lengkap' => $guru->nama_lengkap,
            'jadwal_guru' => $jadwalGuru->values()->all(),
        ];

        // Mengembalikan response menggunakan GuruResource
        return new GuruResource(true, 'Data guru beserta mata pelajaran dan kelas yang diajar', $data);
    }

}

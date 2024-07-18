<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\JadwalPelajaranResource;
use App\Models\JadwalPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JadwalPelajaranController extends Controller
{

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $jadwalPelajaran = JadwalPelajaran::all();
        return new JadwalPelajaranResource(true, 'List Data Jadwal Pelajaran!', $jadwalPelajaran);
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
            'id_kelas' => 'required',
            'id_mapel' => 'required',
            'id_mengajar' => 'required',
            'hari' => 'required',
            'jam_pelajaran' => 'required',
            'semester' => 'required',
        ]);

        // check, if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // create JadwalPelajaran
        $jadwalPelajaran = JadwalPelajaran::create([
            'id_kelas' => $request->id_kelas,
            'id_mapel' => $request->id_mapel,
            'id_mengajar' => $request->id_mengajar,
            'hari' => $request->hari,
            'jam_pelajaran' => $request->jam_pelajaran,
            'semester' => $request->semester,
        ]);

        return new JadwalPelajaranResource(true, 'Data Jadwal Pelajaran Berhasil Ditambahkan', $jadwalPelajaran);
    }

    /**
     * show
     *
     * @param mixed $id
     * @return void
     */
    public function show($id)
    {
        $jadwalPelajaran = JadwalPelajaran::find($id);

        return new JadwalPelajaranResource(true, 'Detail Data Jadwal Pelajaran!', $jadwalPelajaran);
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
            'id_kelas' => 'required',
            'id_mapel' => 'required',
            'id_mengajar' => 'required',
            'hari' => 'required',
            'jam_pelajaran' => 'required',
            'semester' => 'required',
        ]);

        // check, if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $jadwalPelajaran = JadwalPelajaran::find($id);

        // update JadwalPelajaran
        $jadwalPelajaran->update([
            'id_kelas' => $request->id_kelas,
            'id_mapel' => $request->id_mapel,
            'id_mengajar' => $request->id_mengajar,
            'hari' => $request->hari,
            'jam_pelajaran' => $request->jam_pelajaran,
            'semester' => $request->semester,
        ]);

        return new JadwalPelajaranResource(true, 'Data Jadwal Pelajaran Berhasil Diperbarui!', $jadwalPelajaran);
    }

    /**
     * delete/destroy
     *
     * @param mixed $id
     * @return void
     */
    public function destroy($id)
    {
        $jadwalPelajaran = JadwalPelajaran::find($id);

        $jadwalPelajaran->delete();

        return new JadwalPelajaranResource(true, 'Data Jadwal Pelajaran Berhasil Dihapus!', null);
    }
}

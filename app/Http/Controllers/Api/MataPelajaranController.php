<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MataPelajaranResource;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MataPelajaranController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $mataPelajaran = MataPelajaran::all();
        return new MataPelajaranResource(true, 'List Data Mata Pelajaran!', $mataPelajaran);
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
            'kode_mapel' => 'required',
            'nama_mapel' => 'required',
        ]);

        // check, if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // create Mata Pelajaran
        $mataPelajaran = MataPelajaran::create([
            'kode_mapel' => $request->kode_mapel,
            'nama_mapel' => $request->nama_mapel,

        ]);

        return new MataPelajaranResource(true, 'Data Mata Pelajaran Berhasil Ditambahkan', $mataPelajaran);
    }

    /**
     * show
     *
     * @param mixed $id
     * @return void
     */
    public function show($id)
    {
        $mataPelajaran = MataPelajaran::find($id);

        return new MataPelajaranResource(true, 'Detail Data Mata Pelajaran!', $mataPelajaran);
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
            'kode_mapel' => 'required',
            'nama_mapel' => 'required',
        ]);

        // check, if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $mataPelajaran = MataPelajaran::find($id);

        // create Mata Pelajaran
        $mataPelajaran->update([
            'kode_mapel' => $request->kode_mapel,
            'nama_mapel' => $request->nama_mapel,
        ]);

        return new MataPelajaranResource(true, 'Data Mata Pelajaran Berhasil Diperbarui!', $mataPelajaran);
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
        $mataPelajaran = MataPelajaran::find($id);

        $mataPelajaran->delete();

        return new MataPelajaranResource(true, 'Data Mata Pelajaran Berhasil Dihapus!', null);

    }
}

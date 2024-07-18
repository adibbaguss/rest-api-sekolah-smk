<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\KelasResource;
use App\Models\Kelas;
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
}

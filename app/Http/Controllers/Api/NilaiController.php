<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NilaiResource;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NilaiController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $nilai = Nilai::all();
        return new NilaiResource(true, 'List Data Nilai!', $nilai);
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
            'id_siswa' => 'required',
            'id_mapel' => 'required',
            'nilai_angka' => 'required',
        ]);

        // check, if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // create Nilai
        $nilai = Nilai::create([
            'id_siswa' => $request->id_siswa,
            'id_mapel' => $request->id_mapel,
            'nilai_angka' => $request->nilai_angka,
        ]);

        return new NilaiResource(true, 'Data Nilai Berhasil Ditambahkan', $nilai);
    }

    /**
     * show
     *
     * @param mixed $id
     * @return void
     */
    public function show($id)
    {
        $nilai = Nilai::find($id);

        return new NilaiResource(true, 'Detail Data Nilai!', $nilai);
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
            'id_siswa' => 'required',
            'id_mapel' => 'required',
            'nilai_angka' => 'required',
        ]);

        // check, if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $nilai = Nilai::find($id);

        // create Nilai
        $nilai->update([
            'id_siswa' => $request->id_siswa,
            'id_mapel' => $request->id_mapel,
            'nilai_angka' => $request->nilai_angka,
        ]);

        return new NilaiResource(true, 'Data Nilai Berhasil Diperbarui!', $nilai);
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
        $nilai = Nilai::find($id);

        $nilai->delete();

        return new NilaiResource(true, 'Data Nilai Berhasil Dihapus!', null);

    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\JurusanResource;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JurusanController extends Controller
{

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $jurusan = Jurusan::all();
        return new JurusanResource(true, 'List Data Jurusan!', $jurusan);
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
            'kode_jurusan' => 'required',
            'nama_jurusan' => 'required',
        ]);

        // check, if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // create Jurusan
        $jurusan = Jurusan::create([
            'kode_jurusan' => $request->kode_jurusan,
            'nama_jurusan' => $request->nama_jurusan,

        ]);

        return new JurusanResource(true, 'Data Jurusan Berhasil Ditambahkan', $jurusan);
    }

    /**
     * show
     *
     * @param mixed $id
     * @return void
     */
    public function show($id)
    {
        $jurusan = Jurusan::find($id);

        return new JurusanResource(true, 'Detail Data Jurusan!', $jurusan);
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
            'kode_jurusan' => 'required',
            'nama_jurusan' => 'required',
        ]);

        // check, if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $jurusan = Jurusan::find($id);

        // create Jurusan
        $jurusan->update([
            'kode_jurusan' => $request->kode_jurusan,
            'nama_jurusan' => $request->nama_jurusan,
        ]);

        return new JurusanResource(true, 'Data Jurusan Berhasil Diperbarui!', $jurusan);
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
        $jurusan = Jurusan::find($id);

        $jurusan->delete();

        return new JurusanResource(true, 'Data Jurusan Berhasil Dihapus!', null);

    }
}

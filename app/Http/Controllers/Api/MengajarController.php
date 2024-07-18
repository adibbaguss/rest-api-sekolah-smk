<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MengajarResource;
use App\Models\Mengajar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MengajarController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $mengajar = Mengajar::all();
        return new MengajarResource(true, 'List Data Mengajar!', $mengajar);
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
            'kode_mengajar' => 'required',
            'id_guru' => 'required',
            'id_kelas' => 'required',
            'id_mapel' => 'required',
            'semester' => 'required',
        ]);

        // check, if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // create Mengajar
        $mengajar = Mengajar::create([
            'kode_mengajar' => $request->kode_mengajar,
            'id_guru' => $request->id_guru,
            'id_kelas' => $request->id_kelas,
            'id_mapel' => $request->id_mapel,
            'semester' => $request->semester,

        ]);

        return new MengajarResource(true, 'Data Mengajar Berhasil Ditambahkan', $mengajar);
    }

    /**
     * show
     *
     * @param mixed $id
     * @return void
     */
    public function show($id)
    {
        $mengajar = Mengajar::find($id);

        return new MengajarResource(true, 'Detail Data Mengajar!', $mengajar);
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

            'kode_mengajar' => 'required',
            'id_guru' => 'required',
            'id_kelas' => 'required',
            'id_mapel' => 'required',
            'semester' => 'required',
        ]);

        // check, if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $mengajar = Mengajar::find($id);

        // create Mengajar
        $mengajar->update([
            'kode_mengajar' => $request->kode_mengajar,
            'id_guru' => $request->id_guru,
            'id_kelas' => $request->id_kelas,
            'id_mapel' => $request->id_mapel,
            'semester' => $request->semester,
        ]);

        return new MengajarResource(true, 'Data Mengajar Berhasil Diperbarui!', $mengajar);
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
        $mengajar = Mengajar::find($id);

        $mengajar->delete();

        return new MengajarResource(true, 'Data Mengajar Berhasil Dihapus!', null);

    }
}

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
}

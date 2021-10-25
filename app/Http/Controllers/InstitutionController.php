<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Institution;
use App\Models\Major;
use App\Models\Faculty;
use Illuminate\Database\QueryException;
use App\Helper\ResponseHelper;
use Illuminate\Support\Facades\DB;


class InstitutionController extends BaseController
{
    public function getInstitution(request $request)
    {

        $institute =  Institution::all();

        return ResponseHelper::ok('success', $institute);
    }
    public function getInstitutionId(request $request, $id)
    {

        return ResponseHelper::ok('success', Institution::find($id));
    }

    public function newInstitution(request $request)
    {


        try {

            $data = DB::select(
                "insert into institutions (kode_sekolah,nama,tipe,alamat,kab_kota,provinsi,no_telp)
                    values(:kode_sekolah,:nama,:tipe,:alamat,:kab_kota,:provinsi,:no_telp) returning id
                    ",
                [
                    'kode_sekolah' => $request->kode_sekolah,
                    'nama' => $request->nama,
                    'tipe' => $request->tipe,
                    'alamat' => $request->alamat,
                    'kab_kota' => $request->kab_kota,
                    'provinsi' => $request->provinsi,
                    'no_telp' => $request->no_telp,
                ]
            );


            //     ]); 
            //     Major::create([
            //         'id_institusi' => $request->kode_sekolah,
            //         'id_fakultas' => $faculty->id,
            //         'nama_prodi' => $request->nama_prodi,
            //         'email_prodi' => $request->email_prodi,
            //     ]);


            return ResponseHelper::ok('success', $data);
        } catch (QueryException $e) {
            return ResponseHelper::badRequest('error', $e);
        }
    }
    public function newFaculty(request $request)
    {

        try {

            $data = DB::select(
                "insert into faculties (id_institusi,nama_fakultas,email_fakultas)
                    values(:id_institusi,:nama_fakultas,:email_fakultas) returning id
                    ",
                [
                    'id_institusi' => $request->id_institusi,
                    'nama_fakultas' => $request->nama_fakultas,
                    'email_fakultas' => $request->email_fakultas,

                ]
            );

            return ResponseHelper::ok('success', $data);
        } catch (QueryException $e) {
            return ResponseHelper::badRequest('error', $e);
        }
    }
    public function newMajor(request $request)
    {

        try {

            $data = DB::select(
                "insert into majors (id_institusi,id_fakultas,nama_jurusan,email_jurusan)
                    values(:id_institusi,:id_fakultas,:nama_jurusan,:email_jurusan) returning id
                    ",
                [
                    'id_institusi' => $request->id_institusi,
                    'id_fakultas' => $request->id_fakultas,
                    'nama_jurusan' => $request->nama_jurusan,
                    'email_jurusan' => $request->email_jurusan,
                ]
            );

            return ResponseHelper::ok('success', $data);
        } catch (QueryException $e) {
            return ResponseHelper::badRequest('error', $e);
        }
    }

    public function updateInstitution(request $request, $id)
    {

        try {
            Institution::where('id', '=', $id)
                ->update([
                    'kode_sekolah' => $request->kode_sekolah,
                    'nama' => $request->nama,
                    'tipe' => $request->tipe,
                    'alamat' => $request->alamat,
                    'kab_kota' => $request->kab_kota,
                    'provinsi' => $request->provinsi,
                    'email' => $request->email,
                    'no_telp' => $request->no_telp,
                ]);
            return ResponseHelper::ok('success', 'data telah diupdate');
        } catch (QueryException $e) {
            return ResponseHelper::badRequest('error', $e);
        }
    }
}

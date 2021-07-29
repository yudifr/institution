<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Institution;
use App\Models\Major;
use App\Models\Faculty;
use Illuminate\Database\QueryException;
use App\Helper\ResponseHelper;


class InstitutionController extends BaseController
{
    public function getInstitution(request $request)
    {
       
            $institute =  Institution::all();
          
            return ResponseHelper::ok('success',$institute);
       
    }
    public function getInstitutionId(request $request, $id)
    {
       
            return ResponseHelper::ok('success',Institution::find($id));
       
    }

    public function newInstitution(request $request)
    {

       
            try {
                Institution::create([
                    'kode_sekolah' => $request->kode_sekolah,
                    'nama' => $request->nama,
                    'tipe' => $request->tipe,
                    'alamat' => $request->alamat,
                    'kab_kota' => $request->kab_kota,
                    'provinsi' => $request->provinsi,
                    'email' => $request->email,
                    'no_telp' => $request->no_telp,
                ]);
                //temporary, sekarang untuk tes aja
                if($request->tipe == "universitas"){
                    $faculty = Faculty::create([
                        'id_institusi' => $request->kode_sekolah,
                        'nama_fakultas' => $request->nama_fakultas,
                        'email_fakultas' => $request->email_fakultas,
    
                    ]); 
                    Major::create([
                        'id_institusi' => $request->kode_sekolah,
                        'id_fakultas' => $faculty->id,
                        'nama_prodi' => $request->nama_prodi,
                        'email_prodi' => $request->email_prodi,
                    ]);
                }
               
                return ResponseHelper::ok('success','data telah dimasukkan');
            } catch (QueryException $e) {
                return ResponseHelper::badRequest('error',$e);
            }
       
    }
    public function updateInstitution(request $request, $id)
    {
       
            try {
                Institution::where('kode_sekolah','=', $id)
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
                return ResponseHelper::ok('success','data telah diupdate');
            } catch (QueryException $e) {
                return ResponseHelper::badRequest('error',$e);
            }
            
       
    }
    public function deleteInstitution(request $request,$id){
       
            try {
               $a= Institution::destroy($id);
                //temporary sampai ada ui nya, jadi bisa delete banyak fakultas + prodi di satu institusi langsung. sekarang untuk tes aja
                Faculty::where('id_institusi',$id)->delete();
                Major::where('id_institusi',$id)->delete();
                if($a){
                    
                    return ResponseHelper::ok('success','data telah didelete');
                }
                else{
                    return ResponseHelper::badRequest('error',"failed to delete, because id doesn't exist");
                } 
            } catch (QueryException $e) {
                return ResponseHelper::badRequest('error',$e);
            }
            
       
    }
}

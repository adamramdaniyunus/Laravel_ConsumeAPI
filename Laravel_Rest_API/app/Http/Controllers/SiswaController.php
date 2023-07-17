<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;


class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Siswa::all();

        if(!$siswa) {
            return ApiFormatter::createApi(400, 'failed');
        }
        return ApiFormatter::createApi(200, 'success', $siswa);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nis' => 'required|min:8',
                'nama' => 'required',
                'rombel' => 'required',
                'rayon' => 'required',
            ],[
                'nis.required'=>'Fields NIS Wajib diisi',
                'nama.required'=>'Fields Nama Wajib diisi',
                'rombel.required'=>'Fields Rombel Wajib diisi',
                'rayon.required'=>'Fields Rayon Wajib diisi',
            ]);

            $siswa = Siswa::create([
                'nis'=>$request->nis,
                'nama'=>$request->nama,
                'rombel'=>$request->rombel,
                'rayon'=>$request->rayon,
            ]);

            $getData = Siswa::where('id', $siswa->id)->first();

            if(!$getData) {
                return ApiFormatter::createApi(400, 'failed');
            }
             return ApiFormatter::createApi(201, 'success', $getData);

        } catch (Exception $error) {
            return ApiFormatter::createApi(400, 'failed', $error);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $siswa = Siswa::find($id);
            if(!$siswa) {
                return ApiFormatter::createApi(400, 'failed');
            }
            return ApiFormatter::createApi(200, 'success', $siswa);
        } catch (Exception $error) {
            return ApiFormatter::createApi(500, 'Error', $error);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nis' => 'required|min:8',
                'nama' => 'required',
                'rombel' => 'required',
                'rayon' => 'required',
            ]);

            $siswa = Siswa::find($id);
            $siswa->update([
                'nis'=>$request->nis,
                'nama'=>$request->nama,
                'rombel'=>$request->rombel,
                'rayon'=>$request->rayon,
            ]);

            $dataUpdate = Siswa::where('id', $siswa->id)->first();

            if(!$dataUpdate) {
                return ApiFormatter::createApi(400, 'failed');
            }
             return ApiFormatter::createApi(200, 'success', $dataUpdate);

        } catch (Exception $error) {
            return ApiFormatter::createApi(500, 'Error', $error);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $siswa = Siswa::find($id);
            $isSuccess = $siswa->delete();

            if(!$isSuccess) {
                return ApiFormatter::createApi(400, 'failed');
            }
            return ApiFormatter::createApi(200, 'success');

        } catch (Exception $error) {
            return ApiFormatter::createApi(500, 'Error', $error);
        }
    }
}

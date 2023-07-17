<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Libraries\BaseApi;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = (new BaseApi)->index('/api/siswa');
        return view('Home.listSiswa')->with(["siswa"=>$siswa]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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

        if(!$request) {
            return redirect()->back()->with('error', 'Semua Fields Harus Diisi');
        }

        $payload = [
            'nis'=>$request->input('nis'),
            'nama'=>$request->input('nama'),
            'rombel'=>$request->input('rombel'),
            'rayon'=>$request->input('rayon'),
        ];

        $baseApi = new BaseApi;
        $response = $baseApi->create('/api/siswa/create', $payload);

        if($response->failed()) {
            $errors = $response->json();
            return redirect()->back()->with(['errors'=>$errors]);
        } 
        
        return redirect()->back()->with('success', 'Sukses Menambahkan Siswa');
        

       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $response = (new BaseApi)->detail('/api/siswa', $id);
        return view('Home.editSiswa')->with([
            "siswa"=>$response->json()['data']
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
         $payload = [
            'nis'=>$request->input('nis'),
            'nama'=>$request->input('nama'),
            'rombel'=>$request->input('rombel'),
            'rayon'=>$request->input('rayon'),
        ];

        
        $response = (new BaseApi)->update('/api/siswa/edit', $id, $payload);

        if($response->failed()) {
            return redirect()->back()->with('errors', "Gagal MengUpdate Siswa");
        }

        return redirect('/siswa')->with('success', 'Sukses MengUpdate Siswa');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $response = (new BaseApi)->delete('/api/siswa', $id);

         if($response->failed()) {
            $errors = $response->json('data');
            return redirect()->back()->with(['errors'=>$errors]);
        }

        return redirect()->back()->with('success', 'Sukses Menghapus Siswa');
    }
}

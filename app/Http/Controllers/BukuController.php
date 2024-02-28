<?php

namespace App\Http\Controllers;

use App\Models\buku;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        {
            $katakunci = $request->katakunci;
            $jumlahbaris = 3;
            if (strlen($katakunci)) {
                $data = buku::where('nim','like',"%$katakunci%")
                ->orWhere('namabuku','like',"%$katakunci%")
                ->orWhere('deskripsi','like',"%$katakunci%")
                ->paginate($jumlahbaris);
            } else {
                $data = buku::orderBy('nim','desc')->paginate($jumlahbaris);
            }
            return view('buku.index')->with('data', $data);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('buku.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('nim',$request->nim);
        Session::flash('namabuku',$request->namabuku);
        Session::flash('deskripsi',$request->deskripsi);

        $request->validate([
            'nim'=>'required|numeric|unique:buku,nim',
            'namabuku'=>'required',
            'image' => 'required|mimes:png,jpg,jpeg,webp',
            'deskripsi'=>'required',
        ],[
            'nim.required'=>'NIM Wajib diisi!!',
            'nim.numeric'=>'NIM wajib dalam bentuk angka!!',
            'nim.unique'=>'NIM sudah ada',
            'namabuku.required'=>'Nama Buku wajib diisi!!',
            'deskripsi.required'=>'Deskripsi wajib disi!!',
        ]);

        if($request->has('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();

            $filename = time().'.'.$extension;
            $path = 'uploads/buku/';
            $file->move($path, $filename);
        }
        $data = [
           'nim'=>$request->nim,
           'namabuku'=>$request->namabuku,
           'image' => $path.$filename,
           'deskripsi'=>$request->deskripsi, 
        ];
        buku::create($data);
        return redirect()->to('buku')->with('success', 'Berhasil menambahkan data');
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
    public function edit(string $id)
    {
            $data = buku::where('nim', $id)->first();
            return view('buku.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'namabuku'=>'required',
            'deskripsi'=>'required',
        ],[
            'namabuku.required'=>'Nama Buku wajib diisi!!',
            'deskripsi.required'=>'Deskripsi wajib disi!!',
        ]);

        $data = [
           'namabuku'=>$request->namabuku,
           'deskripsi'=>$request->deskripsi, 
        ];
        buku::where('nim',$id)->update($data);
        return redirect()->to('buku')->with('success','Berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        buku::where('nim', $id)->delete();
        return redirect()->to('buku')->with('success', 'Berhasil dihapus');
    }
}

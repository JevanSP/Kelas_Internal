<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisBarang;


class JenisBarangController extends Controller
{
    public function index() 
    { 
        $data = array(
            'title' => 'Jenis Barang',
            'data_jenis_barang' => JenisBarang::all(),
        );
        return view('admin.master.jenisbarang.list', $data);
    }   

    public function store(Request $request)
    {
        JenisBarang::create([
            'nama_jenis' => $request->nama_jenis,
        ]);
        return redirect('/jenisbarang')->with('success', 'Data Berhasil');
    }   

    public function update(Request $request, $id)
    {
            $jenis = JenisBarang::find($id);
            $jenis->update([
            'nama_jenis' => $request->nama_jenis,
        ]);
        return redirect('/jenisbarang')->with('success', 'Data Berhasil');
    }

    public function destroy($id)
    {   
        $data = JenisBarang::find($id);
        $data->delete();
        return redirect('/jenisbarang')->with('success', 'Data Berhasil');
    }


}

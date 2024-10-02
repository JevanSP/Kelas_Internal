<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\JenisBarang;

class BarangController extends Controller
{

    public function index() 
    { 
        $data = array(
            'title'        => 'Barang',
            'data_jenis'   => JenisBarang::all(),
            'data_barang'  => Barang::join('jenis_barang', 'jenis_barang.id', '=', 'barang.id_jenis')
                                    ->select('barang.*', 'jenis_barang.nama_jenis')
                                    ->get(),
        );
    
        return view('admin.master.barang.list', $data);
    }   
    

    // public function add() 
    // { 
    //     $title = 'Jenis Barang';
    //     $data_barang = Jenisbarang::all();
    //     return view('admin.master.barang.add', compact('data_barang', 'title'));
    // }

    public function store(Request $request)
    {
        // $request->validate([
        //     'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);

        // upload file
        $foto = $request->file('foto');
        $path = $foto->store('barang', 'public');
        
        Barang::create([
            'nama_barang'    => $request->nama_barang,
            'foto'           => $path,
            'id_jenis'       => $request->id_jenis,
            'harga'          => $request->harga,
            'stok'           => $request->stok,
        ]);

        return redirect('/barang')->with('success', 'Data Berhasil');
    }   

    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);

        // upload file
        $foto = $request->file('foto');
        $foto->storeAs('/public/barang', $foto->hashName());
        $barang = Barang::find($id);
        $barang->update([
            'nama_barang'    => $request->nama_barang,
            'foto'           => $foto->hashName(),
            'id_jenis'       => $request->id_jenis,
            'harga'          => $request->harga,
            'stok'           => $request->stok,
        ]);
        return redirect('/barang')->with('success', 'Data Berhasil');
    }

    public function destroy($id)
    {
        $data = Barang::find($id);
        $data->delete();
        return redirect('/barang')->with('success', 'Data Berhasil');
    }
}
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
            'title' => 'Barang',
            'data_jenis_barang' => JenisBarang::all(),
            'data_barang'       => Barang::join('jenis_barang', 'id_jenis', '=', 'id_jenis')
                                            ->select('barang.*', 'jenis_barang.nama_jenis')
                                            ->get(),
        );
        return view('admin.master.barang.list', $data);
    }   

    public function store(Request $request)
    {
        $foto = $request->file('foto');
        Barang::create([
            'id_jenis'       => $request->id_jenis,
            'foto'           => $foto->hashName(),
            'nama_barang'    => $request->nama_barang,
            'harga'          => $request->harga,
            'stok'           => $request->stok,
        ]);

        return redirect('/barang')->with('success', 'Data Berhasil');
    }   

    public function update(Request $request, $id)
    {
        $foto = $request->file('foto');
        Barang::where('id', $id)->where('id,', $id)->update
        ([
            'id_jenis'       => $request->id_jenis,
            'foto'           => $foto->hashName(),
            'nama_barang'    => $request->nama_barang,
            'harga'          => $request->harga,
            'stok'           => $request->stok,
        ]);
        return redirect('/barang')->with('success', 'Data Berhasil');
    }

    public function destroy($id)
    {
        Barang::where('id', $id)->delete();
        return redirect('/barang')->with('success', 'Data Berhasil');
    }
}
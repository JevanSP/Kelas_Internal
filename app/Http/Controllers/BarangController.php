<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\JenisBarang;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{

    public function index()
    {
        if (Auth::user()->role != 'admin') {
            return redirect('/')->with('error', 'Unauthorized access');
        }

        $data = array(
            'title'        => 'Barang',
            'data_jenis'   => JenisBarang::all(),
            'data_barang'  => Barang::join('jenis_barang', 'jenis_barang.id', '=', 'barang.id_jenis')
                ->select('barang.*', 'jenis_barang.nama_jenis')
                ->get(),
        );

        return view('admin.master.barang.list', $data);
    }
    
    public function store(Request $request)
    {
        if (Auth::user()->role != 'admin') {
            return redirect('/')->with('error', 'Unauthorized access');
        }

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
        if (Auth::user()->role != 'admin') {
            return redirect('/')->with('error', 'Unauthorized access');
        }

        // $request->validate([
        //     'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);
        $barang = Barang::findOrFail($id);

        //update barang dengan foto
        if ($request->hasFile('foto')) {

            //upload image
            $foto = $request->file('foto');
            $foto->storeAs('/public/barang', $foto->hashName());

            //delete old image
            Storage::delete('public/barang'.$barang->foto);

            //update product
            $barang->update([
                'nama_barang'    => $request->nama_barang,
                'foto'           => $foto->hashName(),
                'id_jenis'       => $request->id_jenis,
                'harga'          => $request->harga,
                'stok'           => $request->stok,
            ]);

        } else {

            //update product without image
            $barang->update([
                'nama_barang' => $request->nama_barang,
                'id_jenis'    => $request->id_jenis,
                'harga'       => $request->harga,
                'stok'        => $request->stok
            ]);
        }
        return redirect('/barang')->with('success', 'Data Berhasil');
    }

    public function destroy($id)
    {
        if (Auth::user()->role != 'admin') {
            return redirect('/')->with('error', 'Unauthorized access');
        }

        $data = Barang::find($id);
        $data->delete();
        return redirect('/barang')->with('success', 'Data Berhasil');
    }
}

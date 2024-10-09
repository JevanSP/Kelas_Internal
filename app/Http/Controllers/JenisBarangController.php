<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisBarang;
use Illuminate\Support\Facades\Auth;


class JenisBarangController extends Controller
{
    public function index() 
    { 
        if (Auth::user()->role != 'admin') {
            return redirect('/')->with('error', 'Unauthorized access');
        }

        $data = array(
            'title' => 'Jenis Barang',
            'data_jenis_barang' => JenisBarang::all(),
        );
        return view('admin.master.jenisbarang.list', $data);
    }   

    public function store(Request $request)
    {
        if (Auth::user()->role != 'admin') {
            return redirect('/')->with('error', 'Unauthorized access');
        }

        JenisBarang::create([
            'nama_jenis' => $request->nama_jenis,
        ]);
        return redirect('/jenisbarang')->with('success', 'Data Berhasil');
    }   

    public function update(Request $request, $id)
    {
        if (Auth::user()->role != 'admin') {
            return redirect('/')->with('error', 'Unauthorized access');
        }

            $jenis = JenisBarang::find($id);
            $jenis->update([
            'nama_jenis' => $request->nama_jenis,
        ]);
        return redirect('/jenisbarang')->with('success', 'Data Berhasil');
    }

    public function destroy($id)
    {   
        if (Auth::user()->role != 'admin') {
            return redirect('/')->with('error', 'Unauthorized access');
        }

        $data = JenisBarang::find($id);
        $data->delete();
        return redirect('/jenisbarang')->with('success', 'Data Berhasil');
    }


}

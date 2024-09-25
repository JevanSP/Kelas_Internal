<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Transaksi',
            'data_transaksi' => Transaksi::all()
        );
        return view('kasir.transaksi.list', $data);
    }

    public function store(Request $request)
    {
        Transaksi::create([
            'no_transaksi'  => $request->no_transaksi,
            'tgl_transaksi' => $request->tgl_transaksi,
            'total_harga'   => $request->total_harga,
            'uang_masuk'    => $request->uang_masuk,
            'kembalian'     => $request->kembalian
        ]);
        return redirect('/transaksi')->with('success', 'Data Berhasil');
    }

    public function update(Request $request, $id)
    {
        Transaksi::where('id', $id)->where('id,', $id)->update([
            'no_transaksi'  => $request->no_transaksi,
            'tgl_transaksi' => $request->tgl_transaksi,
            'total_harga'   => $request->total_harga,
            'uang_masuk'    => $request->uang_masuk,
            'kembalian'     => $request->kembalian
        ]);
        return redirect('/transaksi')->with('success', 'Data Berhasil');
    }

    public function destroy($id)
    {
        $data = Transaksi::find($id);
        $data->delete();
        return redirect('/transaksi')->with('success', 'Data Berhasil');
    }
}




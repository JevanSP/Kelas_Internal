<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\Auth;

class DetailTransaksiController extends Controller
{
    public function index()
    {
        if (Auth::user()->role != 'kasir') {
            return redirect('/')->with('error', 'Unauthorized access');
        }

            $title = 'Data Detail Transaksi';
            $data_detail_transaksi = DetailTransaksi::all();
        return view('kasir.detailtransaksi.list', compact('data_detail_transaksi', 'title'));
    }       

    public function add()
    {
        if (Auth::user()->role != 'admin') {
            return redirect('/')->with('error', 'Unauthorized access');
        }

            $title = 'Data Barangi';
            $data_barang = DetailTransaksi::all();
        return view('kasir.detailtransaksi.add', compact('data_detail_barang', 'title'));
    }   

    public function store(Request $request)
    {
        DetailTransaksi::create([
            'no_transaksi'  => $request->no_transaksi,
            'nama_barang'   => $request->nama_barang,
            'harga'         => $request->harga,
            'qty'           => $request->qty,
            'subtotal'      => $request->subtotal,
        ]);
        return redirect('/detail_transaksi')->with('success', 'Data Berhasil');
    }
    
    public function update(Request $request, $id)
    {
        DetailTransaksi::where('id', $id)->where('id,', $id)->update([
            'no_transaksi'  => $request->no_transaksi,
            'nama_barang'   => $request->nama_barang,
            'harga'         => $request->harga,
            'qty'           => $request->qty,
            'subtotal'      => $request->subtotal,
        ]);
        return redirect('/detail_transaksi')->with('success', 'Data Berhasil');
    }

    public function destroy($id)
    {
        $data = DetailTransaksi::find($id);
        $data->delete();
        return redirect('/detail_transaksi')->with('success', 'Data Berhasil');
    }

    
}

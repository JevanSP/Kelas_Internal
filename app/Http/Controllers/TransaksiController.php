<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Barang;

class TransaksiController extends Controller
{
    public function index()
    {
        $title = 'Data Transaksi';
        $data_detail_transaksi = DetailTransaksi::with('barang')->get();
        $data_transaksi = Transaksi::with('detailtransaksi')->get();
        return view('kasir.transaksi.list',compact('data_detail_transaksi','data_transaksi', 'title'));
    }

    public function add()
    {
            $title = 'Data Detail Transaksi';
            $data_detail_transaksi = Barang::all();
            $data_transaksi = DetailTransaksi::all();
        return view('kasir.transaksi.add',compact('data_detail_transaksi', 'data_transaksi', 'title'));
    }


    public function store(Request $request)
    {   
        DetailTransaksi::create([
            'no_transaksi'  => $request->no_transaksi,
            'nama_barang'   => $request->nama_barang,
            'harga'         => $request->harga,
            'qty'           => $request->qty,
            'subtotal'      => $request->qty * $request->harga == $request->subtotal,
        ]);
        Transaksi::create([
            'no_transaksi'  => $request->no_transaksi,
            'tgl_transaksi' => $request->tgl_transaksi,
            'total_harga'   => $request->subtotal == $request->total_harga,
            'uang_masuk'    => $request->uang_masuk,
            'kembalian'     => $request->uang_masuk - $request->total_harga == $request->kembalian
        ]);
        return redirect('/transaksi')->with('success', 'Data Berhasil');
    }

    
    public function destroy($id)
    {
        $data = DetailTransaksi::find($id);
        $data->delete();
        $data = Transaksi::find($id);
        $data->delete();
        return redirect('/transaksi')->with('success', 'Data Berhasil');
    }
}




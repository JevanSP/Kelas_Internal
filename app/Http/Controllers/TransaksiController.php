<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;


class TransaksiController extends Controller
{
    public function index()
    {
        if (Auth::user()->role != 'kasir') {
            return redirect('/')->with('error', 'Unauthorized access');
        }

        $title = 'Data Transaksi';
        $data_detail_transaksi = DetailTransaksi::with('barang')->get();
        $data_transaksi = Transaksi::with('detailtransaksi')->get();
        return view('kasir.transaksi.list',compact('data_detail_transaksi','data_transaksi', 'title'));
    }

    public function add()
    {
        if (Auth::user()->role != 'kasir') {
            return redirect('/')->with('error', 'Unauthorized access');
        }

        $title = 'Data Detail Transaksi';
        $data_detail_transaksi = Barang::all();
        $data_transaksi = DetailTransaksi::all();
        return view('kasir.transaksi.add', compact('data_detail_transaksi', 'data_transaksi', 'title'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role != 'kasir') {
            return redirect('/')->with('error', 'Unauthorized access');
        }
        
            @dd($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Data transaksi berhasil ditambahkan',
            ]);

        
    }
}

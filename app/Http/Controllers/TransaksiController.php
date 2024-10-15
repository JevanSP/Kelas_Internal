<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class TransaksiController extends Controller
{
    public function index()
    {
        if (Auth::user()->role != 'kasir') {
            return redirect('/')->with('error', 'Unauthorized access');
        }

        $title = 'Data Transaksi';
        // $data_detail_transaksi = DetailTransaksi::with('barang')->get();
        $data_transaksi = Transaksi::with('Detail_Transaksi')->get();

        return view('kasir.transaksi.list', compact('data_transaksi', 'title'));
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

        // Ambil ID user yang sedang login
        $userId = Auth::id();

        // Mulai transaksi database
        DB::beginTransaction();

        try {
            // Simpan data ke tabel transaksi
            /**
             * @var Transaksi $transaksi
             */
            $transaksi = Transaksi::create([
                'id' => $request->input('id'),
                'tgl_transaksi' => date('Y-m-d'),
                'user_id' => $userId,
                'total_bayar' => $request->input('total'),
                'uang_masuk' => str_replace('.', '', $request->input('bayar')),      // Menghilangkan titik pada pembayaran_cs
                'kembalian' => $request->input('kembalian'),
            ]);

            //Simpan data ke tabel detail_transaksi
            foreach ($request->input('items') as $item) {
                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'barang_id' => $item['id'], // Pastikan ID barang digunakan
                    'harga' => $item['harga_satuan'],
                    'qty' => $item['qty'],
                    'subtotal' => $item['subtotal'],
                ]);

                // Mengurangi stok barang
                $barang = Barang::find($item['id']);
                if ($barang) {
                    $barang->stok -= $item['qty'];
                    $barang->save();
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil disimpan!',
                'transaksi' => $transaksi,
            ]);

            // Jika terjadi kesalahan, rollback transaksi database
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()], 500);
        }
    }


    public function view_pdf($id)
    {
        if (Auth::user()->role != 'kasir') {
            return redirect('/')->with('error', 'Unauthorized access');
        }

        $data_cetak = Transaksi::with('Detail_Transaksi')->find($id);
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML(view('kasir.transaksi.cetak', compact('data_cetak')));
        $mpdf->Output();
    }


    public function download_pdf($id)
    {
        if (Auth::user()->role != 'kasir') {
            return redirect('/')->with('error', 'Unauthorized access');
        }
        $data_cetak = Transaksi::with('Detail_Transaksi')->find($id);
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML(view('kasir.transaksi.cetak', compact('data_cetak')));
        $mpdf->Output('cetak_management_mebel.pdf', 'D');
    }


    public function detail($id)
    {
        if (Auth::user()->role != 'kasir') {
            return redirect('/')->with('error', 'Unauthorized access');
        }

        $title = 'Data Detail Transaksi';
        $data_detail_transaksi = Transaksi::with('Detail_Transaksi')->find($id);


        return view('kasir.transaksi.detail', compact('data_detail_transaksi', 'title'));
    }
}

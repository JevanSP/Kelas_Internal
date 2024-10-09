<?php

namespace App\Http\Controllers;
use App\Models\JenisBarang;
use App\Models\Barang;

use Illuminate\Http\Request;

class HomeController extends Controller
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
        return view('home', $data);
    }
}

@extends('layout.layout')
@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="text-center text-block py-4">DATA STOK
                </h1>
                <div class="row">
                </div>
                <div class="card mb-4">
                    <div class="card-header text-center">
                        <i class="fas fa-table me-1"></i>
                        MEBEL GACOR
                    </div>
                    <div class="card-body">
                        <table class="" id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama Barang</th>
                                    <th class="col-sm-3 text-center">Foto</th>
                                    <th class="text-center">Jenis Barang</th>
                                    <th class="text-center">Harga</th>
                                    <th class="text-center">Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($data_barang as $row)
                                    <tr>
                                        <td class="text-center">{{ $no++ }}</td>
                                        <td class="text-center">{{ $row->nama_barang }}</td>
                                        <td class="text-center">
                                            <img src="{{ asset('storage/' . $row->foto) }}" class="rounded"
                                                style="width: 50px">
                                        </td>
                                        <td class="text-center">{{ $row->nama_jenis }}</td>
                                        <td>Rp. {{ number_format($row->harga) }}</td>
                                        <td class="text-center">{{ $row->stok }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection

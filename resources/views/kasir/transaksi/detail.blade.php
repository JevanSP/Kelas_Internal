@extends('layout.layout')
@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Data {{ $title }}</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">MEBEL GACOR</li>
                </ol>
                <div class="row">
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Detail {{ $title }}
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>No Transaksi</th>
                                    <th>Nama Barang</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>          
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ( $data_detail_transaksi as $row )
                                <tr>
                                    <td>NT-00{{ $no++ }}</td>
                                    <td>{{ $row->nama_barang }}</td>
                                    <td>{{ number_format($row->harga) }}</td>
                                    <td>{{ $row->qty }}</td>
                                    <td>{{ number_format($row->subtotal) }}</td>
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

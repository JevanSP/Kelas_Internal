@extends('layout.layout')
@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">{{ $title }}</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">MEBEL GACOR</li>
                </ol>
                <div class="row">
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        @if ($data_detail_transaksi->detail_transaksi->isnotempty())
                            <h3>NT-{{ $data_detail_transaksi->detail_transaksi->first()->transaksi_id }}</h3>
                        @endif
                        
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>          
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ( $data_detail_transaksi->detail_transaksi as $row )
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $row->barang->nama_barang }}</td>
                                    <td>{{ $row->qty }}</td>
                                    <td>Rp. {{ number_format($row->barang->harga) }}</td>
                                    <td>Rp. {{ number_format($row->subtotal) }}</td>
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

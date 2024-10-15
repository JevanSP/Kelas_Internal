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
                    <i class="fas fa-table me-1"></i>
                    {{ $title }}
                </div>
                <a href="/transaksi/add" class="btn btn-primary">+ TAMBAH TRANSAKSI</a>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No Transaksi</th>
                                <th>Kasir</th>
                                <th>Tanggal</th>
                                <th>Total Bayar</th>
                                <th>Uang Masuk</th>
                                <th>Uang Kembalian</th>
                                <th>Action</th>
                            </tr>
                        </thead>          
                        <tbody>
                          @foreach ( $data_transaksi as $row )
                          
                            <tr>
                                <td>NT-{{ $row->id }}</td>
                                <td>{{ $row->user->name }}</td>
                                <td>{{ $row->tgl_transaksi }}</td>
                                <td>Rp. {{ number_format($row->total_bayar) }}</td>
                                <td>Rp. {{ number_format($row->uang_masuk) }}</td>
                                <td>Rp. {{ number_format($row->kembalian) }}</td>
                                <td>
                                  <a type="button" href="/transaksi/detail/{{ $row->id }}" class="btn btn-primary"><i class="fas fa-detail"></i>Detail</a></button>
                                  <a type="button" href="/transaksi/view_pdf/{{ $row->id }}" class="btn btn-success"><i class="fas fa-print"></i>Cetak</a></button>
                                  {{-- <button type="button" data-bs-target="#modaldelete{{ $row->id }}" data-bs-toggle="modal" class="btn btn-danger"><i class="fas fa-trash"></i>Delete</button> --}}
                                </td>
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


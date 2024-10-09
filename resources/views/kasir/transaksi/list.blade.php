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
                                <th>Tanggal</th>
                                <th>Total Bayar</th>
                                <th>Uang Masuk</th>
                                <th>Uang Kembalian</th>
                                <th>Action</th>
                            </tr>
                        </thead>          
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                          @foreach ( $data_transaksi as $row )
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ date('d-m-Y', strtotime($row->tgl_transaksi)) }}</td>
                                <td>{{ number_format($row->total_bayar) }}</td>
                                <td>{{ number_format($row->uang_masuk) }}</td>
                                <td>{{ number_format($row->uang_kembalian) }}</td>
                                <td>
                                  <button type="button" href=/detailtransaksi/detail class="btn btn-primary"><i class="fas fa-detail"></i>Detail</a></button>
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
{{-- <div class="modal fade" id="modalcreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Tambah Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="POST" action="/transaksi/store/">
        @csrf
        <div class="form-group">
          <label>Tanggal</label>
          <input type="text" class="form-control" name="tgl_transaksi"required>  
        </div>     
        <div class="form-group">
          <label>Total Bayar</label>
          <input type="text" class="form-control" name="total_bayar"required>  
        </div>          
        <div class="form-group">
          <label>Uang Masuk</label>
          <input type="text" class="form-control" name="uang_masuk"required>  
        </div>  
        <div class="form-group">
          <label>Uang Kembalian</label>
          <input type="text" class="form-control" name="uang_kembalian"required>  
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-undo"></i></button>
        <button type="button" class="btn btn-primary" class="fas fa-save">Save Changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

@foreach ( $data_transaksi as $d )
<div class="modal fade" id="modaledit{{ $d->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Edit {{ $title }}</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="POST" action="/transaksi/update/{{ $d->id }}">
        @csrf
        <div class="form-group">
          <label>Tanggal</label>
          <input type="text" value="{{ $d->tgl_transaksi }}" class="form-control" name="tgl_transaksi"required>  
        </div>  
        <div class="form-group">
          <label>Total Bayar</label>
          <input type="text" value="{{ $d->taol_bayar }}" class="form-control" name="total_bayar"required>
        </div>
        <div class="form-group">
          <label>Uang Masuk</label>
          <input type="text" value="{{ $d->uang_masuk }}" class="form-control" name="uang_masuk"required>
        </div>
        <div class="form-group">
          <label>Subtotal</label>
          <input type="text" value="{{ $d->subtotal }}" class="form-control" name="subtotal"required>
        </div>              
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-undo">Close</i></button>
        <button type="button" class="btn btn-primary" class="fas fa-save">Save Changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endforeach

@foreach ( $data_transaksi as $c )
<div class="modal fade" id="modaldelete{{ $c->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Edit {{ $title }}</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="GET" action="/detailtransaksi/destroy/{{ $c->id }}">
      <div class="form-group">
        <h5>Apakah anda yakin ingin menghapus data ini?</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-undo">Close</i></button>
        <button type="button" class="btn btn-danger" class="fas fa-trash">Buak</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endforeach --}}
@endsection 


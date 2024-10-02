@extends('layout.layout')
@section('content')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">{{ $title }}</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Yuk Di Beli{{ $title }}</li>
            </ol>
            <div class="row">
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Data {{ $title }}
                </div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalcreate">+ TAMBAH DATA</button>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No Transaksi</th>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                                <th>Action</th>
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
                                <td>{{ $row->harga }}</td>
                                <td>{{ $row->qty }}</td>
                                <td>{{ $row->subtotal }}</td>
                                <td>
                                    <a href=#modalEdit {{ $row->id }} data-bs-toggle="modal" class="btn btn-primary"><i class="fas fa-edit"></i>Edit</a>
                                    <a href=#modalDelete {{ $row->id }} data-bs-toggle="modal" class="btn btn-danger"><i class="fas fa-trash"></i>Delete</a>
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
      <form method="POST" action="/detailtransaksi/store/">
        @csrf
        <div class="form-group">
          <label>Nama Barang</label>
          <input type="text" class="form-control" name="nama_jenis"required>  
        </div>     
        <div class="form-group">
          <label>Harga</label>
          <input type="text" class="form-control" name="harga"required>  
        </div>          
        <div class="form-group">
          <label>Qty</label>
          <input type="text" class="form-control" name="qty"required>  
        </div>  
        <div class="form-group">
          <label>Subtotal</label>
          <input type="text" class="form-control" name="subtotal"required>  
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-undo"></i></button>
        <button type="submit" class="btn btn-primary" class="fas fa-save">Save Changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

@foreach ( $data_detail_transaksi as $d )
<div class="modal fade" id="modaledit{{ $d->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Edit {{ $title }}</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="POST" action="/detailtransaksi/update/{{ $d->id }}">
        @csrf
        <div class="form-group">
          <label>Nama Barang</label>
          <input type="text" value="{{ $d->nama_barang }}" class="form-control" name="nama_barang"required>  
        </div>  
        <div class="form-group">
          <label>Harga</label>
          <input type="text" value="{{ $d->harga }}" class="form-control" name="harga"required>
        </div>
        <div class="form-group">
          <label>Qty</label>
          <input type="text" value="{{ $d->qty }}" class="form-control" name="qty"required>
        </div>
        <div class="form-group">
          <label>Subtotal</label>
          <input type="text" value="{{ $d->subtotal }}" class="form-control" name="subtotal"required>
        </div>              
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-undo">Close</i></button>
        <button type="submit" class="btn btn-primary" class="fas fa-save">Save Changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endforeach

@foreach ( $data_detail_transaksi as $c )
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
        <button type="submit" class="btn btn-danger" class="fas fa-trash">Buak</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endforeach --}}
@endsection 


@extends('layout.layout')
@section('content')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Data {{ $title }}</h1>
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
                                <th>Jenis Barang</th>
                                <th>Foto</th>
                                <th>Barang</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Action</th>
                            </tr>
                        </thead>          
                        <tbody>
                          @php
                                $no = 1;
                            @endphp
                          @foreach ( $data_barang as $row )
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $row->nama_jenis }}</td>
                                <td>{{ $row->foto }}</td>
                                <td>{{ $row->nama_barang }}</td>
                                <td>Rp. {{ number_format($row->harga) }}</td>
                                <td>{{ $row->stok }}</td>
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
<div class="modal fade" id="modalcreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Tambah Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="POST" action="/barang/store/">
        @csrf
        <div class="form-group">
          <label>Jenis Barang</label>
          <select name="id_jenis" class="form-control"required>
            <option value="">== Pilih Jenis Barang ==</option>
            @foreach ( $data_jenis_barang as $b )
              <option value="{{ $b->id }}">{{ $b->nama_jenis }}</option>
            @endforeach
        </div>
        <div class="form-group">
          <label>Nama Barang</label>
          <input type="text" class="form-control" name="nama_barang"required>  
        </div>
        <div class="form-group">
          <label>Harga</label>
          <input type="number" class="form-control" name="harga"required>  
        </div>
        <div class="form-group">
          <label>Stok</label>
          <input type="number" class="form-control" name="stok"required>  
        </div>                  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-undo"></i></button>
        <button type="button" class="btn btn-primary" class="fas fa-save">Save Changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

@foreach ( $data_barang as $d )
<div class="modal fade" id="modaledit{{ $d->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Edit {{ $title }}</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="POST" action="/barang/update/{{ $d->id }}">
        @csrf
        <div class="form-group">
          <label>Jenis Barang</label>
          <select name="id_jenis" class="form-control"required>
            <option value="{{ $d->id_jenis }}">{{ $d->nama_jenis }}</option>
            @foreach ( $data_jenis_barang as $b )
              <option value="{{ $b->id }}">{{ $b->nama_jenis }}</option>
            @endforeach
        </div>
        <div class="form-group">
          <label>Nama Barang</label>
          <input type="text" value="{{ $d->nama_barang }}" class="form-control" name="nama_barang"required>  
        </div>
        <div class="form-group">
          <label>Harga</label>
          <input type="number" value="{{ $d->harga }}" class="form-control" name="harga"required>  
        </div>
        <div class="form-group">
          <label>Stok</label>
          <input type="number" value="{{ $d->stok }}" class="form-control" name="stok"required>  
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

@foreach ( $data_barang as $c )
<div class="modal fade" id="modaldelete{{ $c->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Edit {{ $title }}</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="GET" action="/barang/destroy/{{ $c->id }}">
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
@endforeach
@endsection 


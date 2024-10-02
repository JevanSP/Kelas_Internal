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
                        MEBEL GACORR
                    </div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalcreate">+
                        TAMBAH DATA</button>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama Barang</th>
                                    <th class="col-sm-3 text-center">Foto</th>
                                    <th class="text-center">Jenis Barang</th>
                                    <th class="text-center">Harga</th>
                                    <th class="text-center">Stok</th>
                                    <th class="text-center">Action</th>
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
                                            <img src="{{ asset ('storage/'.$row->foto) }}" class="rounded"
                                                style="width: 50px">
                                        </td>
                                        <td class="text-center">{{ $row->nama_jenis }}</td>
                                        <td>Rp. {{ number_format($row->harga) }}</td>
                                        <td class="text-center">{{ $row->stok }}</td>
                                        <td class="text-center">
                                            <button type="button" data-bs-target="#modaledit{{ $row->id }}"
                                                data-bs-toggle="modal" class="btn btn-primary"><i
                                                    class="fas fa-edit"></i>Edit</button>
                                            <button type="button" data-bs-target="#modaldelete{{ $row->id }}"
                                                data-bs-toggle="modal" class="btn btn-danger"><i
                                                    class="fas fa-trash"></i>Delete</button>
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
                    <form method="POST" action="/barang/store/" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <label>Nama Barang</label>
                            <input type="text" class="form-control" name="nama_barang"required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="foto">Foto</label>
                            <input type="file" class="form-control" accept="image/*" name="foto"required>
                        </div>
                        <div class="form-group mb-2">
                            <label>Jenis Barang</label>
                            <select class="form-control" name="id_jenis">
                                <option value="" hidden>-- Nama Jenis Barang --</option>
                                @foreach ($data_jenis as $b)
                                    <option value="{{ $b->id }}">{{ $b->nama_jenis }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label>Harga</label>
                            <input type="number" class="form-control" name="harga"required>
                        </div>
                        <div class="form-group mb-2">
                            <label>Stok</label>
                            <input type="number" class="form-control" name="stok"required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                            class="fas fa-undo"></i></button>
                    <button type="submit" class="btn btn-primary" class="fas fa-save">Save Changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($data_barang as $d)
        <div class="modal fade" id="modaledit{{ $d->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Edit {{ $title }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="/barang/update/{{ $d->id }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group mb-2">
                                <label>Nama Barang</label>
                                <input type="text" value="{{ $d->nama_barang }}" class="form-control"
                                    name="nama_barang"required>
                            </div>
                            <div class="form-group mb-2">
                                <label>Foto</label>
                                <div class="input-group mb-2">
                                    <input type="file" value="{{ $d->foto }}" class="form-control"
                                        @error('foto') is-invalid @enderror name="foto"> <label
                                        class="input-group-text" for="foto">Upload</label>
                                    @error('foto')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label>Jenis Barang</label>
                                <select class="form-control" name="id_jenis" required>
                                    <option value="{{ $d->id_jenis }}" selected>{{ $d->nama_jenis }}</option>
                                    @foreach ($data_jenis as $jenis)
                                        @if ($jenis->id != $d->id_jenis)
                                            <option value="{{ $jenis->id }}">{{ $jenis->nama_jenis }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label>Harga</label>
                                <input type="number" value="{{ $d->harga }}" class="form-control"
                                    name="harga"required>
                            </div>
                            <div class="form-group mb-2">
                                <label>Stok</label>
                                <input type="number" value="{{ $d->stok }}" class="form-control"
                                    name="stok"required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                                    class="fas fa-undo">Close</i></button>
                            <button type="submit" class="btn btn-primary" class="fas fa-save">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($data_barang as $c)
        <div class="modal fade" id="modaldelete{{ $c->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
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
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                                        class="fas fa-undo">Close</i></button>
                                <button type="submit" class="btn btn-danger" class="fas fa-trash">Buak</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    @endforeach
@endsection

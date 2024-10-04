@extends('layout.layout')
@section('content')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css"
        integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Data {{ $title }}</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">MEBEL GACOR</li>
                </ol>

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        MEBEL GACORR
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Foto</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_detail_transaksi as $row)
                                    <tr>
                                        <td>{{ $row->nama_barang }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $row->foto) }}" class="rounded"
                                                style="width: 50px">
                                        </td>
                                        <td>Rp. {{ number_format($row->harga) }}</td>
                                        <td>{{ $row->stok }}</td>
                                        <td>
                                            <button type="button"
                                                onclick="addToCart('{{ $row->id }}', '{{ $row->nama_barang }}', '{{ asset('storage/' . $row->foto) }}', '{{ $row->harga }}')"
                                                class="btn btn-primary">
                                                <i class="fas fa-shopping-cart"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="container-fluid px-4">
                <div class="row">
                    @foreach ($data_detail_transaksi as $row )
                    <script>
                        function addToCart(id, namabarang, foto, harga) {
                            // Get the container where you want to add the new transaction item
                            var container = document.querySelector('.row');

                            // Create a new div to represent the new cart item
                            var newItem = document.createElement('div');
                            newItem.classList.add('col-xl-6');
                            newItem.innerHTML = `
                                    <div class="card border shadow-none mb-4">
                                        <div class="card-body">
                                            <div class="d-flex align-items-start pb-3">
                                                <div class="me-4">
                                                    <img width="60" src="${foto}" alt="" class="avatar-lg rounded">
                                                </div>
                                                <div class="flex-grow-1 align-self-center overflow-hidden"> 
                                                    <div>
                                                        <h5 class="text-truncate font-size-18"><a href="#" class="text-dark">${namabarang}</a></h5>
                                                        <p class="text-muted mb-2">Harga</p>
                                                        <h5 class="mb-0 mt-2">Rp. ${parseInt(harga).toLocaleString()}</h5>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <p class="text-muted mb-2">Quantity</p>
                                                    <div class="d-inline-flex">
                                                        <select class="form-select form-select-sm w-xl" onchange="updateSubTotal(this, ${harga})">
                                                            <option value="0" selected>0</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mt-3">
                                                        <p class="text-muted mb-2">Subtotal</p>
                                                        <h5 class="item-total">Rp.</h5>
                                                    </div>
                                                </div>
                                                <div class="flex-shrink-0 ms-2">
                                                    <ul class="list-inline mb-0 font-size-16">
                                                        <li class="list-inline-item">
                                                            <a href="#" class="text-muted px-1" onclick="removeItem(this)">
                                                                <i class="mdi mdi-trash-can-outline"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `;

                            // Append the new item to the container
                            container.appendChild(newItem);
                        }

                        function updateSubTotal(selectElement, harga) {
                            var quantity = parseInt(selectElement.value);
                            var subtotalElement = selectElement.closest('.d-flex').nextElementSibling.querySelector('.item-total');

                            // Calculate subtotal
                            var subtotal = qty * harga;

                            // Update the subtotal display
                            subtotalElement.textContent = 'Rp. ' + subtotal.toLocaleString();

                            // Optionally, you can call updateGrandTotal here if you want to update the grand total whenever an item is added or updated
                            updateGrandTotal();
                        }

                        function removeItem(element) {
                            var item = element.closest('.col-xl-6');
                            item.remove();
                        }
                    </script>
                @endforeach

                    {{-- <div class="card border shadow-none mb-4">
                            <div class="card-body">
                                <div class="d-flex align-items-start pb-3">
                                    <div class="me-4">
                                        <img width="60" src="{{ asset('storage/' . $row->foto) }}" alt=""
                                            class="avatar-lg rounded">
                                    </div>
                                    <div class="flex-grow-1 align-self-center overflow-hidden">
                                        <div>
                                            <h5 class="text-truncate font-size-18"><a href="#"
                                                    class="text-dark">{{ $row->nama_barang }}</a></h5>
                                            <p class="text-muted mb-2">Harga</p>
                                            <h5 class="mb-0 mt-2">Rp. {{ number_format($row->harga) }}</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <p class="text-muted mb-2">Quantity</p>
                                        <div class="d-inline-flex">
                                            <select class="form-select form-select-sm w-xl">
                                                <option value="0" selected="">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mt-3">
                                            <p class="text-muted mb-2">Subtotal</p>
                                            <h5>Rp. {{ $row->subtotal }}</h5>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0 ms-2">
                                        <ul class="list-inline mb-0 font-size-16">
                                            <li class="list-inline-item">
                                                <a href="#" class="text-muted px-1">
                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="#" class="text-muted px-1">
                                                    <i class="mdi mdi-heart-outline"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                {{-- </div> --}}
                <div class="col-xl-full">
                    <div class="mt-5 mt-lg-0">
                        <div class="card border shadow-none">
                            <div class="card-header bg-transparent border-bottom py-3 px-4">
                                <h5 class="font-size-16 mb-0">Order Summary <span class="float-end">#MN0124</span>
                                </h5>
                            </div>
                            <div class="card-body p-4 pt-2">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <tbody>
                                            <tr>
                                                <td>Sub Total :</td>
                                                <td class="text-end">{{ $row->subtotal }}</td>
                                            </tr>
                                            <tr>
                                                <td>Nama Barang :
                                                    <input name="nama_barang" type="text" class="form-control"
                                                        aria-describedby="emailHelp">
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>Tanggal :
                                                    <input name="tanggal" type="date" class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Estimated Tax : </td>
                                                <td class="text-end">$ 18.20</td>
                                            </tr>
                                            <tr class="bg-light">
                                                <th>Total :</th>
                                                <td class="text-end">
                                                    <span class="fw-bold">
                                                        {{-- {{ $request->total_harga }} --}}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Uang Masuk :
                                                    <input name="uang_masuk" type="text" class="form-control"
                                                        aria-describedby="emailHelp">
                                                </td>s
                                            </tr>
                                            <tr>
                                                <td>Uang Kembalian : </td>
                                                <td class="text-end">Rp.{{ $row->uang_kembalian }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- end table-responsive -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row my-4">
                <div class="col-sm-11">
                    <div class="text-sm-end mt-2 mt-sm-0">
                        <a href="ecommerce-checkout.html" class="btn btn-success">
                            <i class="mdi mdi-cart-outline me-1"></i> Checkout </a>
                    </div>
                </div> <!-- end col -->
            </div>
    </div>
    </div>
    </div>


    </main>
    </div>
@endsection

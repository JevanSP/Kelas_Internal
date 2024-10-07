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
                                                onclick="addToCart('{{ $row->id }}', '{{ $row->nama_barang }}', '{{ asset('storage/' . $row->foto) }}', '{{ $row->harga }}',{{ $row->stok }})"
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
                <div class="row" id="cart-items">
                    <!-- Cart items will be added here dynamically -->
                </div>

                <div class="col-xl-full">
                    <div class="mt-5 mt-lg-0">
                        <div class="card border shadow-none">
                            <div class="card-header bg-transparent border-bottom py-3 px-4">
                                @php
                                    $no = 1;
                                @endphp
                                <h5 class="font-size-16 mb-0">Order Summary <span class="float-end">#NT012{{ $no++ }}</span></h5>
                            </div>
                            <div class="card-body p-4 pt-2">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <tbody>
                                            <tr>
                                                <td>Nama Kasir :</td>
                                                <td>
                                                    <input name="name" type="text" class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal :</td>
                                                <td>
                                                    <input name="tanggal" type="date" class="form-control">
                                                </td>
                                            </tr>
                                            <tr class="bg-light">
                                                <th>Total :</th>
                                                <td class="text-end">
                                                    <span class="fw-bold grand-total">Rp. 0</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Uang Masuk :</td>
                                                <td>
                                                    <input name="uang_masuk" type="text" class="form-control" id="uangMasuk" oninput="hitungKembalian()">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Uang Kembalian :</td>
                                                <td>
                                                    <input name="uang_kembalian" type="text" class="form-control" id="uangKembalian" readonly>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row my-4">
                    <div class="col-sm-11">
                        <div class="text-sm-end mt-2 mt-sm-0">
                            <a href="ecommerce-checkout.html" class="btn btn-success">
                                <i class="mdi mdi-cart-outline me-1"></i> Checkout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        function addToCart(id, nama_barang, foto, harga, stok) {
            var container = document.getElementById('cart-items');

            var newItem = document.createElement('div');
            newItem.classList.add('col-xl-6');
            newItem.setAttribute('data-id', id);
            newItem.setAttribute('data-stok', stok);
            newItem.setAttribute('data-harga', harga);
            newItem.innerHTML = `
                <div class="card border shadow-none mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-start pb-3">
                            <div class="me-4">
                                <img width="60" src="${foto}" alt="" class="avatar-lg rounded">
                            </div>
                            <div class="flex-grow-1 align-self-center overflow-hidden">
                                <div>
                                    <h5 class="text-truncate font-size-18"><a href="#" class="text-dark">${nama_barang}</a></h5>
                                    <p class="text-muted mb-2">Harga</p>
                                    <h5 class="mb-0 mt-2">Rp. ${parseInt(harga).toLocaleString()}</h5>
                                    <p class="text-muted">Stok Tersedia: <span class="item-stock">${stok}</span></p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <p class="text-muted mb-2">Quantity</p>
                                <div class="d-inline-flex">
                                    <select class="form-select form-select-sm" onchange="updateSubTotal(this, ${harga}, ${stok})">
                                        ${[...Array(stok + 1).keys()].map(num => `<option value="${num}">${num}</option>`).join('')}
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mt-3">
                                    <p class="text-muted mb-2">Subtotal</p>
                                    <h5 class="item-total">Rp. 0</h5>
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
            container.appendChild(newItem);
            updateGrandTotal();
        }

        function updateSubTotal(selectElement, harga, stok) {
            var quantity = parseInt(selectElement.value);
            var subtotalElement = selectElement.closest('.d-inline-flex').parentNode.nextElementSibling.querySelector('.item-total');
            var subtotal = quantity * harga;
            subtotalElement.textContent = 'Rp. ' + subtotal.toLocaleString();

            var itemContainer = selectElement.closest('.col-xl-6');
            var stockElement = itemContainer.querySelector('.item-stock');
            stockElement.textContent = stok - quantity;

            updateGrandTotal();
        }

        function removeItem(element) {
            element.closest('.col-xl-6').remove();
            updateGrandTotal();
        }

        function updateGrandTotal() {
            var grandTotal = 0;
            document.querySelectorAll('.item-total').forEach(function(item) {
                grandTotal += parseInt(item.textContent.replace('Rp. ', '').replace(/,/g, '')) || 0;
            });
            document.querySelector('.grand-total').textContent = 'Rp. ' + grandTotal.toLocaleString();
        }

        function hitungKembalian() {
            var uangMasuk = parseInt(document.getElementById('uangMasuk').value) || 0;
            var grandTotal = parseInt(document.querySelector('.grand-total').textContent.replace('Rp. ', '').replace(/,/g, '')) || 0;

            var uangKembalian = uangMasuk - grandTotal;
            document.getElementById('uangKembalian').value = 'Rp. ' + (uangKembalian > 0 ? uangKembalian.toLocaleString() : 0);
        }
    </script>
@endsection

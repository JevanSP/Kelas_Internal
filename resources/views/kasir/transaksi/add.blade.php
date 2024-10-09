@extends('layout.layout')
@section('content')
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Data {{ $title }}</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">MEBEL GACOR</li>
                </ol>

                <!-- Product Table -->
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
                                        <td><img src="{{ asset('storage/' . $row->foto) }}" class="rounded"
                                                style="width: 50px"></td>
                                        <td>Rp. {{ number_format($row->harga) }}</td>
                                        <td>{{ $row->stok }}</td>
                                        <td>
                                            <button type="button"
                                                onclick="addToCart('{{ $row->id }}', '{{ $row->nama_barang }}', '{{ asset('storage/' . $row->foto) }}', '{{ $row->harga }}', {{ $row->stok }})"
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
                                <h5 class="font-size-16 mb-0">Order Summary
                                    <span class="float-end">#NT012{{ $no++ }}</span>
                                </h5>
                            </div>
                            <div class="card-body p-4 pt-2">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <tbody>
                                            <tr>
                                                <td>Nama Kasir :
                                                    <input name="name" type="text" class="form-control" disabled
                                                        value="{{ Auth::user()->name }}">
                                                </td>
                                                <td>Tanggal :
                                                    <input name="date" type="text" class="form-control" disabled
                                                        value="{{ date('d-m-Y') }}" id="date">
                                                </td>
                                            </tr>
                                            <tr class="bg-light">
                                                <th>Total :</th>
                                                <td class="text-end">
                                                    <span class="fw-bold grand-total">Rp. 0</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Uang Masuk :
                                                    <input name="uang_masuk" type="text" class="form-control"
                                                        id="uangMasuk" oninput="hitungKembalian()">
                                                </td>
                                                <td>Uang Kembalian :
                                                    <input name="uang_kembalian" type="text" class="form-control"
                                                        id="uangKembalian" readonly>
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
                    <div class="col-sm-6">
                        <a href="ecommerce-products.html" class="btn btn-link text-muted">
                            <i class="mdi mdi-arrow-left me-1"></i> Continue Shopping
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end mt-2 mt-sm-0">
                            <a href="javascript:void(0)" class="btn btn-success btn-checkout">
                                <i class="mdi mdi-cart-outline me-1"></i> Checkout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        let cartItems = [];

        function addToCart(id, nama_barang, foto, harga, stok) {
            var container = document.getElementById('cart-items');

            var newItem = document.createElement('div');
            newItem.classList.add('col-md-6');
            newItem.setAttribute('data-id', id);
            newItem.setAttribute('data-stok', stok);
            newItem.setAttribute('data-harga', harga);

            var quantityOptions = '';
            for (var i = 0; i <= stok; i++) {
                quantityOptions += `<option value="${i}">${i}</option>`;
            }

            newItem.innerHTML = `
                <div class="card border shadow-none mb-2">
                    <div class="card-body">
                        <div class="d-flex align-items-start border-bottom">
                            <div class="me-4">
                                <img width="60" src="${foto}" alt="" class="avatar-lg rounded">
                            </div>
                            <div class="flex-grow-1 align-self-center overflow-hidden">
                                <div>
                                    <h5 class="text-truncate fs-4">${nama_barang}</h5>
                                    <p class="text-muted mb-1 mt-1">Rp. <span class="fw-medium text-dark">${parseInt(harga).toLocaleString()}</span></p>
                                    <p class="text-muted">Stok Tersedia: <span class="item-stock text-dark">${stok}</span></p>
                                </div>
                            </div>  
                            <div class="flex-shrink-0 ms-2">
                                <ul class="list-inline mb-0 font-size-16">
                                    <li class="list-inline-item">
                                        <a href="#" class="text-muted px-1" onclick="removeItem(this)">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div>
                            <div class="row">
                                <div class="col-md-3">
                                    <p class="text-muted mb-2 mt-1">Quantity</p>
                                    <div class="d-inline-flex">
                                        <select class="form-select form-select-sm" onchange="updateSubTotal(this, ${id}, ${harga}, ${stok})">
                                            ${quantityOptions}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mt-1">
                                        <p class="text-muted mb-1">Subtotal</p>
                                        <h5 class="item-total mb-0 mt-2 text-dark">Rp. 0</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            container.appendChild(newItem);
            updateGrandTotal();
        }

        function updateSubTotal(selectElement, id, harga, stok) {
            var quantity = parseInt(selectElement.value);

            // Validasi jika kuantitas lebih dari stok
            if (quantity > stok) {
                alert("Jumlah barang melebihi stok yang tersedia.");
                return;
            }

            var subtotalElement = selectElement.closest('.d-inline-flex').parentNode.nextElementSibling.querySelector(
                '.item-total');
            var subtotal = quantity * harga;
            subtotalElement.textContent = 'Rp. ' + subtotal.toLocaleString();

            var itemContainer = selectElement.closest('.col-md-6');
            var stockElement = itemContainer.querySelector('.item-stock');
            stockElement.textContent = stok - quantity;

            const itemIndex = cartItems.findIndex(item => item.id === id);
            if (itemIndex > -1) {
                cartItems[itemIndex].qty = quantity;
                cartItems[itemIndex].subtotal = subtotal;
            } else {
                cartItems.push({
                    id: id,
                    qty: quantity,
                    harga_satuan: harga,
                    subtotal: subtotal,
                });
            }

            updateGrandTotal();
        }

        function removeItem(element) {
            var itemContainer = element.closest('.col-md-6');
            var itemId = itemContainer.getAttribute('data-id');
            cartItems = cartItems.filter(item => item.id != itemId);
            itemContainer.remove();
            updateGrandTotal();
        }

        function updateGrandTotal() {
            var grandTotal = cartItems.reduce((total, item) => total + item.subtotal, 0);
            document.querySelector('.grand-total').textContent = 'Rp. ' + grandTotal.toLocaleString();
        }

        function hitungKembalian() {
            var uangMasuk = parseInt(document.getElementById('uangMasuk').value) || 0;
            var grandTotal = parseInt(document.querySelector('.grand-total').textContent.replace('Rp. ', '').replace(/,/g,
                '')) || 0;

            var uangKembalian = uangMasuk - grandTotal;

            if (uangKembalian < 0) {
                document.getElementById('uangKembalian').value = 'Uang tidak cukup';
            } else {
                document.getElementById('uangKembalian').value = 'Rp. ' + uangKembalian.toLocaleString();
            }
        }
        function checkout() {
            const uangMasuk = parseInt(document.getElementById('uangMasuk').value) || 0;
            const uangkembalian = parseInt(document.getElementById('uangKembalian').value.replace('Rp. ', '').replace(/,/g,
                '')) || 0;
            const grandTotal = parseInt(document.querySelector('.grand-total').textContent.replace('Rp. ', '').replace(/,/g,
                '')) || 0;
            const date = document.getElementById('date').value;

            fetch('/transaksi/store', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token
                    },
                    body: JSON.stringify({
                        items: cartItems,
                        bayar: uangMasuk,
                        kembalian: uangkembalian,
                        total: grandTotal,
                        date: date
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = '/transaksi'; // Jika berhasil, arahkan ke halaman transaksi
                    } else {
                        alert('Terjadi kesalahan: ' + data.message);
                    }
                })
                .catch(error => {
                    alert('Terjadi kesalahan saat checkout. Silakan coba lagi.');
                });
        }

        document.getElementById('uangMasuk').addEventListener('input', enableCheckoutButton);
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.btn-success').addEventListener('click', function(event) {
                event.preventDefault();
                checkout();
            });
        });
    </script>
@endsection

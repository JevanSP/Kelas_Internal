<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .header {
            text-align: start;
            margin-bottom: 20px;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            border: 1px solid #bbb7b7;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .total-row {
            background-color: #77c8da;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>NT-{{ $data_cetak->detail_transaksi->first()->transaksi_id }}</h1>
        <h3>Nama: {{ Auth::user()->name }}</h3>
        <h3>Tanggal: {{ $data_cetak->tgl_transaksi }}</h3>
    </div>

    <div class="card">
        <table class="table">
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
                @foreach ($data_cetak->detail_transaksi as $row)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->barang->nama_barang }}</td>
                        <td>{{ $row->qty }}</td>
                        <td style="text-align: right"> {{ number_format($row->barang->harga) }}</td>
                        <td style="text-align: right"> {{ number_format($row->subtotal) }}</td>
                    </tr>
                @endforeach
                <tr class="total-row">
                    <td colspan="4">Total</td>
                    <td style="text-align: right"> {{ number_format($data_cetak->total_bayar) }}</td>
                </tr>
                <tr class="total-row">
                    <td colspan="4">Uang Masuk</td>
                    <td style="text-align: right"> {{ number_format($data_cetak->uang_masuk) }}</td>
                </tr>
                <tr class="total-row">
                    <td colspan="4">Uang Kembalian</td>
                    <td style="text-align: right"> {{ number_format($data_cetak->kembalian) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
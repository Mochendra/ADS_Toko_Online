<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="Background-keranjang font">
    <div class="container mt-4">
        <div class="mb-4">
            <a href="/dashboard" class="btn btn-secondary">Kembali</a>
        </div>
        <h2 class="text-center" style="margin-top: 10px; margin-bottom: 60px;">Keranjang Belanja</h2>
        <div class="table-container">
            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart as $productId => $item)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if (isset($item['image_path']))
                                        <img src="{{ asset('storage/' . $item['image_path']) }}"
                                            alt="{{ $item['name'] }}"
                                            style="width: 50px; height: 50px; margin-right: 10px;">
                                    @else
                                        <span>No image available</span>
                                    @endif
                                    {{ $item['name'] }}
                                </div>
                            </td>
                            <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('cart.update') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $productId }}">
                                    <input type="number" class="form-control" name="quantity"
                                        value="{{ $item['quantity'] }}" min="1" onchange="this.form.submit()">
                                </form>
                            </td>
                            <td>Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('cart.remove') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $productId }}">
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end mt-3">
            <h5>Total Keseluruhan: Rp {{ number_format($total, 0, ',', '.') }}</h5>
        </div>
        <div class="d-flex justify-content-end mt-3">
            <a href="/checkout" class="btn btn-success" style="margin-bottom: 100px;">Lanjut Pembayaran</a>
        </div>
    </div>
</body>

</html>

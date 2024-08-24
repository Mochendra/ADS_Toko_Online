<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        .card {
            backdrop-filter: blur(5px);
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .container {
            max-width: 500px;
        }
    </style>
</head>

<body class="Background-checkout font">
    <div class="container mt-4">
        <h2 class="text-center" style="margin-bottom: 60px; color:aliceblue;">Checkout</h2>
        <div class="card mb-4">
            <div class="card-header">
                Ringkasan Belanja
            </div>
            <div class="card-body">
                <ul class="list-group">
                    @foreach ($cart as $productId => $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $item['name'] }} ({{ $item['quantity'] }})
                            <span>Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                        </li>
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>Total</strong>
                        <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                Informasi Pembayaran
            </div>
            <div class="card-body">
                <p>Silakan transfer total belanja Anda ke rekening berikut:</p>
                <p><strong>Bank XYZ</strong></p>
                <p>Nomor Rekening: <strong>123-456-7890</strong></p>
                <p>Atas Nama: <strong>Nama Anda</strong></p>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                Unggah Bukti Pembayaran
            </div>
            <div class="card-body">
                <form id="paymentForm" action="{{ route('checkout.process') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="payment_proof" class="form-label">Upload Bukti Pembayaran</label>
                        <input class="form-control" type="file" id="payment_proof" name="payment_proof" required>
                    </div>
                    <div class="mb-3">
                        <label for="shipping_address" class="form-label">Alamat Pengiriman</label>
                        <textarea class="form-control" id="shipping_address" name="shipping_address" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim Bukti Pembayaran</button>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Pembelian Berhasil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Produk yang Anda beli telah berhasil diproses. Terima kasih atas pembelian Anda!<br>
                    <strong>Alamat Pengiriman:</strong>
                    <p id="shippingAddress"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function confirmSubmission() {
            var alamat = document.getElementById('shipping_address').value;
            document.getElementById('shippingAddress').innerText = alamat;

            var myModal = new bootstrap.Modal(document.getElementById('successModal'));
            myModal.show();
        }
    </script>
</body>

</html>

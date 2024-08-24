<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+5hb5oJgQ3P7f5b95mZJh4T+DE7qEk12e2wO8y6" crossorigin="anonymous">
</head>
<style>
    .custom-navbar {
        background-color: #ffffff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
</style>

<body class="Background-dashboard font">
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('images/logo.png') }}" alt="Logo"
                    style="width: 100px; height: 55px; margin-right: 10px;">
                Selamat datang di Katalog kami
            </a>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="d-flex align-items-center ms-auto">
                    <a href="/keranjang" class="nav-link">
                        <img src="{{ asset('illustrations/troli.svg') }}" alt="Keranjang"
                            style="width: 40px; height: 40px;">
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container mt-4 foto-depan">
        <img src="{{ asset('images/open.png') }}" class="img-fluid" alt="..."
            style="width: 370px; height: 250px; margin-top: 27px; margin-bottom: 15px">
    </div>
    <h5 class="judul-toko">- Toko Online Hendra Buah -</h5>
    <div class="container mt-4 isi-konten">
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <img src="{{ asset('storage/' . $product->image_path) }}" class="card-img-top img-fluid"
                            alt="{{ $product->name }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <h6 class="card-price">Harga: Rp {{ number_format($product->price, 0, ',', '.') }}</h6>
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="product_name" value="{{ $product->name }}">
                                <input type="hidden" name="product_price" value="{{ $product->price }}">
                                <input type="hidden" name="image_path" value="{{ $product->image_path }}">
                                <button type="submit" class="btn btn-success">Tambah ke Keranjang</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>

</html>

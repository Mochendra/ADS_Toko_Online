<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<style>
    .container {
        max-width: 800px;
    }
</style>

<body class="Background-admin font">
    <div class="container">
        <div class="mb-3 blur-card" style="margin-top: 60px; margin-bottom: 50px">
            <label for="formFile" class="form-label">Selamat Datang Admin!</label>
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input class="form-control" type="file" id="formFile" name="image"
                    style="margin-top: 10px; margin-bottom: 10px;" required>
                <div class="mb-3">
                    <label for="title" class="form-label">Isi Judul</label>
                    <input type="text" class="form-control" id="title" name="name"
                        placeholder="Masukan Judul Buah" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Isi Deskripsi</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Harga</label>
                    <input type="number" class="form-control" id="price" name="price"
                        placeholder="Masukan Harga Buah" required>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary" style="margin-top:30px">Upload</button>
                </div>
            </form>
        </div>

        <h3>Produk yang ditampilkan</h3>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <img src="{{ asset('storage/' . $product->image_path) }}" class="card-img-top"
                            alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <h6 class="card-price">Harga: Rp {{ number_format($product->price, 0, ',', '.') }}</h6>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>

                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

</body>

</html>

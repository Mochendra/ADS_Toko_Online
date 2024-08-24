<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<style>
    .container {
        max-width: 400px;
    }
</style>

<body class="Background-login font">
    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="card-body blur-card-login" style="max-width: 300px;">
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

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Selamat datang</label>
                    <p class="italic-text">Isi untuk login.</p>
                    <input type="text" class="form-control" name="email" placeholder="Masukkan email" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Masukkan kata sandi"
                        required>
                </div>
                <button type="submit" class="btn btn-success">Masuk</button>
            </form>
            <div class="mt-3 text-center">
                <p>Belum punya akun? <a href="{{ route('register') }}" class="link-primary">Daftar di sini</a></p>
            </div>
        </div>
    </div>
</body>

</html>

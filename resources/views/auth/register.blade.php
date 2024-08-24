<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
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
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" name="name" placeholder="Masukkan nama" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Masukkan email" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kata Sandi</label>
                    <input type="password" class="form-control" name="password" placeholder="Masukkan kata sandi"
                        required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Konfirmasi Kata Sandi</label>
                    <input type="password" class="form-control" name="password_confirmation"
                        placeholder="Konfirmasi kata sandi" required>
                </div>
                <button type="submit" class="btn btn-success">Daftar</button>
            </form>
            <div class="mt-3 text-center">
                <p>Sudah punya akun? <a href="{{ route('login') }}" class="link-primary">Masuk di sini</a></p>
            </div>
        </div>
    </div>
</body>

</html>

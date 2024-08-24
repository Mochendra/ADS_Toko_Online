<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Layout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
            @yield('content')
        </div>
    </div>
</body>

</html>
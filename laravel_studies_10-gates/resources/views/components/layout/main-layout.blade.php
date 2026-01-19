<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel gates</title>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/bootstrap.min.css') }}">
</head>
<body>
    
    <div class="container mt-3">

        <p class="display-6">Laravel gates</p>
        <hr>

        @auth 
            <p>
                <span class="text-info me-3">{{ Auth::user()->name }}</span>
                <a href="{{ route('logout') }}">Logout</a>
            </p>
        @else 
            <p class="opacity-75">
                Nenhum usuário logado
            </p>
        @endauth


    </div>

    {{ $slot }}


    <script src="{{ asset('assets/bootstrap/bootstrap.bundle.min.css') }}"></script>
</body>
</html>
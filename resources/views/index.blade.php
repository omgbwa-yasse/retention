<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Vos balises meta et title ici -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <!-- CSS de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Votre CSS personnalisé -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
</head>
<body id="app">
    <div class="container-fluid">@include('menuTop')
    
        <div class="row">
            <div class="col-2">
                @include('menuAside')
            </div>
            <div class="col-9">
                @yield('content')
            </div>
        </div>
        <div class="row">
            @include('footer')
        </div>
    </div>

    <!-- Scripts de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

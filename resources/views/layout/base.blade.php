<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield("title")</title>
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">--}}
    @stack("head")
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #16b534">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Finanzas</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 w-100" style="color: white">
                <li class="nav-item">
                    <a class="nav-link @yield('link1')" href="{{route('listBillfold')}}" aria-current="page">Mis Carteras</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @yield('link2')" href="{{route('addBillfold')}}">Agregar Cartera</a>
                </li>

                <div class="spacer"></div>

                <li class="nav-item">
                    <a class="nav-link active" >{{$_SESSION['userName']}}</a>
                </li>

                <li class="nav-item" style="margin-left: auto">
                    <form action="{{route('logout')}}" method="POST" style="display:inline;" onsubmit="return confirmLogout();">
                        @csrf
                        <a ><button class="nav-link" type="submit"><i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesion</button></a>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
@yield("body")
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/7d0f24146e.js" crossorigin="anonymous"></script>
<script>
    function confirmLogout() {
        return confirm("¿Estás seguro de que deseas cerrar sesión?");
    }
</script>

@stack("scripts")
</body>
</html>

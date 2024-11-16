
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/login.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/login.css')}}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
<div id="loginBanner">
    <div class="login-banner" style="height: 90vh;">
        <img style="height: 100vh; width: 100%;" src="{{asset('assets/images/login-banner1.jpg')}}" alt="login-banner">
    </div>
    <div  class="d-flex justify-content-center"><button id="displayButton" class="btn btn-primary">Iniciar Sesión</button></div>
</div>
<div id="loginContainer" class="w-100" style="display: none; height: 100vh;">
    <div class="d-flex justify-content-center w-100 align-content-center align-items-center" style="height: 100vh">
        <form id="{{route('validateCredentials')}}" method="POST" class="login-form p-3 rounded-3" style="background: #D9D9D9">
            @csrf
            <div class="form-group" >
                <label for="exampleInputEmail1">Email</label>
                <input name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>

{{--            <div class="form-group">--}}
{{--                <input type="hidden" hidden name="_token" id="token" value="{{csrf_token()}}">--}}
{{--            </div>--}}
            <div class="d-flex justify-content-center mt-3"><button type="submit" class="btn btn-primary">Iniciar Sesión</button></div>
            <small id="emailHelp" class="form-text text-muted">¿Aun no tienes una cuenta?. <a href="{{route('registerView')}}">Registrate</a></small>
            @if (session('message'))
                <div class="alert alert-danger mt-3">
                    {{ session('message') }}
                </div>
                <script>
                    $('#loginBanner').slideUp(0);
                    $('#loginContainer').show(0);
                </script>
            @endif
        </form></div>




</div>



    <script>
        $(document).ready(function() {

            $('#displayButton').click(function (){
                loginAnim();
            });

            function loginAnim(){
                $('#loginBanner').slideUp(500);
                $('#loginContainer').show(500);
            }

        });

    </script>
</body>
</html>








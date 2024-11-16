
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrar</title>
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/login.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/login.css')}}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
<div id="loginContainer" class="w-100" style="height: 100vh;">

    <div class="d-flex justify-content-center flex-column w-100 align-content-center align-items-center" style="height: 100vh">
        <h1>Registrar</h1>
        <form id="register-form" href="{{route('register')}}" method="POST" class="login-form p-3 rounded-3" style="background: #D9D9D9">
            @csrf
            <div class="form-group" >
                <label for="exampleInputEmail1">Nombres</label>
                <input name="name" class="form-control" id="nameInput" aria-describedby="emailHelp" placeholder="Example Name" required>
            </div>
            <div class="form-group" >
                <label for="exampleInputEmail1">RUC</label>
                <input name="ruc" class="form-control" id="rucInput" aria-describedby="emailHelp" placeholder="10000000000" required>
            </div>
            <div class="form-group" >
                <label for="exampleInputEmail1">Email</label>
                <input name="email" class="form-control" id="emailInput" aria-describedby="emailHelp" placeholder="Enter email" required>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control" id="passwordInput" placeholder="******" required>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Confirm Password</label>
                <input type="password" name="confirm-password" class="form-control" id="confirmPasswordInput" placeholder="******" required>
                <small id="password-help" class="form-text text-muted" style="display: none; color: orangered !important;">La contraseña no coincide</small>
            </div>

{{--            <div class="form-group">--}}
{{--                <input type="hidden" hidden name="_token" id="token" value="{{csrf_token()}}">--}}
{{--            </div>--}}
            <div class="d-flex justify-content-center mt-3"><button id="send-button" type="submit" class="btn btn-primary" disabled>Registrar</button></div>
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

            $('#register-form').on('input', function() {
                // Verificamos si el formulario es válido
                $('#send-button').prop('disabled', !this.checkValidity());
                if (!validateInputs()) return;
                validatePassword();
            });

            function validateInputs(){
                let name = $('#nameInput').val();
                let ruc = $('#rucInput').val();
                let pass = $('#passwordInput').val();
                let cPass = $('#confirmPasswordInput').val();

                if (name.trim() === '' || ruc.trim() === '' || pass.trim() === '' || cPass.trim() === '' ) {
                    $('#send-button').prop('disabled', true);
                    return false;
                } else return true


            }

            function validatePassword(){
                let pass = $('#passwordInput').val();
                let cPass = $('#confirmPasswordInput').val();

                if (cPass.length < 1 || (pass === '' && cPass === '')) return;

                if(cPass === '' ||  (pass !== cPass) ) {
                    console.log(1)
                    $('#send-button').prop('disabled', true);
                    $('#password-help').show()
                } else {
                    console.log(2)
                    $('#send-button').prop('disabled', false);
                    $('#password-help').hide()
                }
            }



        });





    </script>
</body>
</html>








@extends('layout.base')

@section('link2', 'active')

@section('body')
<div id="loginContainer" class="w-100 d-flex justify-content-center" style="height: 100vh;">

    <div class="d-flex flex-column justify-content-center align-content-center align-items-center" style="height: 100vh; width: 50%;">
        <h1 class="mb-4">Nueva Cartera</h1>
        <form action="{{ route('addBillfold') }}" method="POST" id="loginForm" class="login-form p-3 rounded-3 w-100" style="background: #D9D9D9">

            @csrf
            <div class="form-group" >
                <label for="exampleInputEmail1">Nombre</label>
                <input type="text" name="name" class="form-control" id="exampleInputEmail1" required placeholder="Mi Cartera Nueva">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Fecha de descuento</label>
                <input class="form-control" type="date" name="discount_date" required/>
            </div>


            <div class="d-flex justify-content-center mt-3">
                <button type="button" class="btn btn-primary me-3" onclick="clearForm()"><i class="fa-solid fa-eraser"></i> Limpiar</button>
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
                <div class="spacer"></div>
                <a href="{{route('listBillfold')}}"><button type="button" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i></button></a>

            </div>

        </form>


        <div id="response-section" class="card mt-3 w-100" style="display: none">
            <div class="card-title text-center"><b>Resultado</b></div>
            <div id="response-body" class="card-body"></div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>



    function clearForm(){
        $('input[name="name"]').val('');
        $('input[name="discount_date"]').val("");
        // console.log($('select[name="discount_date"]'));
    }
</script>
@endpush

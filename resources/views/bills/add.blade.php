<?php
$title = "Agregar Letra / Factura | Cartera " . $data['billfold']['name'];
?>

@section('title', $title)


@extends('layout.base')

@section('body')
    <div id="loginContainer" class="w-100 d-flex justify-content-center" style="height: 100vh;">
        <div class="d-flex flex-column justify-content-center align-content-center align-items-center" style="height: 100vh; width: 50%;">
            <h1 class="mb-4">{{$title}}</h1>
            <form action="{{route('saveBill')}}" method="POST" id="loginForm" class="login-form p-3 rounded-3 w-100" style="background: #D9D9D9">

                @csrf
                <input hidden class="form-control" type="text" value="{{$data['billfold']['id']}}}" name="billfold_id"/>

                <div class="form-group">
                    <label for="exampleInputEmail1">Fecha inicio</label>
                    <input class="form-control" type="date" name="emission_at" required value="{{old('emission_at')}}"/>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Fecha final</label>
                    <input id="expiration_at" class="form-control" type="date" name="expiration_at" required value="{{old('expiration_at')}}"/>
                    <small  class="form-text text-muted">Diferencia de dias con la fecha de descuento: <small id="expiration_message"></small></small>
                </div>


                <div class="form-group" >
                    <label for="exampleInputEmail1">Monto</label>
                    <input type="text" name="amount" class="form-control" id="exampleInputEmail1" required value="{{old('amount')}}" placeholder="100">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Tipo de tasa</label>
                    <select class="form-select " id="select-type-interest" aria-label="Seleccionar tipo de tasa" name="interest_type">
                        <option value="1" {{ old('interest_type') == '1' ? 'selected' : '' }}>Efectiva</option>
                        <option value="2" {{ old('interest_type') == '2' ? 'selected' : '' }}>Nominal</option>
                    </select>
                </div>


                <div class="form-group">
                    <label for="exampleInputPassword1">Tasa de intereses (%)</label>
                    <input type="text" name="interest_rate" class="form-control" id="exampleInputPassword1" value="{{old('interest_rate')}}" placeholder="7.5" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Frecuencia</label>
                    <select class="form-select" name="interest_frequency" required>
                        @foreach($data['frequencies'] as $value => $label)
                            <option value="{{ $value }}" {{ old('interest_frequency', '1') == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group" id="cap-input" style="display: none">
                    <label for="exampleInputPassword1">Capitalización</label>
                    <select class="form-select" name="interest_capitalization" required>
                        @foreach($data['frequencies'] as $value => $label)
                            <option value="{{ $value }}" {{ old('interest_capitalization', '1') == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Otros Costos</label>
                    <input type="text" name="other_costs" class="form-control" id="exampleInputPassword1" value="{{old('other_costs')}}" placeholder="10" required>
                </div>

{{--                <div class="form-group">--}}
{{--                    <input type="checkbox" class="form-check-input" id="checkBox">--}}
{{--                    <label for="exampleInputPassword1">Existe plazo de gracia</label>--}}
{{--                </div>--}}

                <div class="mt-3">

{{--                        <button type="button" class="btn btn-primary" onclick="testForm()">Test</button>--}}
                        <button type="button" class="btn btn-primary" onclick="clearForm()">Limpiar</button>
                        {{--                <div class="d-flex justify-content-center mt-3"><button type="button" class="btn btn-primary" onclick="calculate()">Calcular</button></div>--}}
                        <button type="submit" class="btn btn-primary">Guardar</button>


                </div>

                @if (session('error'))
                    <div class="alert alert-danger mt-3">
                        {{ session('error') }}
                    </div>
                @endif

            </form>

            <a href="{{url()->previous()}}" class="mt-3"><button type="button" class="btn btn-primary">Volver</button></a>

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
        const billfoldDate =  '{{$data['billfold']['discount_date']}}';

        $('#expiration_at').on('change', function (){
            const expirationDate =  this.value

            const [yearS, monthS, dayS] = expirationDate.split('-').map(Number);
            const [yearE, monthE, dayE, hourE = 0, minE = 0, secE = 0] =
                billfoldDate.split(/[- :]/).map(Number);

            const startUTC = Date.UTC(yearS, monthS - 1, dayS);
            const endUTC = Date.UTC(yearE, monthE - 1, dayE, hourE, minE, secE);



            const millisDifference = startUTC - endUTC;

            const millisPerDay = 1000 * 60 * 60 * 24;
            const daysDiff = Math.ceil(millisDifference / millisPerDay);

            $('#expiration_message').html(daysDiff);

        });

        $('#select-type-interest').on('change', function (){
            let cap = $('#cap-input');
            console.log('hola')
            if ($(this).val() === '1'){
                cap.hide();
                console.log('hola1')
            } else {
                cap.show();
                console.log('hola2')
            }
        })

        function clearForm(){
            $('input[name="emission_at"]').val('');
            $('input[name="expiration_at"]').val('');
            $('input[name="amount"]').val('');
            $('select[name="interest_type"]').val('1')
            $('input[name="interest_rate"]').val('');
            $('input[name="other_costs"]').val('');
            $('select[name="interest_frequency"]').val('1');
            $('select[name="interest_capitalization"]').val('1');
            $('#checkBox').prop('checked', false);
        }

        function testForm(){
            $('input[name="emission_at"]').val('2024-10-01');
            $('input[name="expiration_at"]').val('2024-10-31');
            $('input[name="amount"]').val('10000');
            $('select[name="interest_type"]').val('1')
            $('input[name="interest_rate"]').val('7.5');
            $('input[name="other_costs"]').val('10');
            $('select[name="interest_frequency"]').val('1');
            $('#checkBox').prop('checked', false);
            $('#response-section').css('display', 'none');
        }
    </script>
@endpush

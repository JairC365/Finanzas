<!-- resources/views/bills/index.blade.php -->
<?php
$title = "Resultados | Cartera " . $matrix['billfold']['name'];
?>

@extends('layout.base')

@section('title', $title)

@section('body')
<div class="container mt-5">
    <h1 class="mb-4">{{$title}}</h1>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Monto</th>
            <th>Otros Costos</th>
            <th>Fecha de descuento</th>
            <th>Fecha de vencimiento</th>
            <th>Diferencia de Días</th>
            <th>Descuento</th>
            <th>Descuento Neto</th>
            <th>TCEA (%)</th>
        </tr>
        </thead>
        <tbody>
        @foreach($matrix['data'] as $bill)
            <tr>
                <td>{{ $bill['amount'] }}</td>
                <td>{{ $bill['other_costs'] }}</td>
                <td>{{ $bill['discount_date'] }}</td>
                <td>{{ $bill['expiration_at'] }}</td>
                <td>{{ $bill['days'] }}</td>
                <td class="text-end">{{ $bill['discount'] }}</td>
                <td class="text-end">{{ $bill['netDiscount']}}</td>
                <td class="text-end">{{ $bill['tcea']}}</td>
            </tr>
        @endforeach
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="text-end">{{$matrix['netValue']}}</td>
            <td class="text-end">{{$matrix['tcea']}}</td>
        </tr>
        </tbody>
    </table>
    <a href="{{url()->previous()}}"><button type="button" class="btn btn-primary">Volver</button></a>
</div>
@endsection

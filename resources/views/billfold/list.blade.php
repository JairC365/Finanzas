<?php
    $title = "Lista de Carteras";
?>

@extends('layout.base')

@section('title', $title)

@section('link1', 'active')

@section('body')
<div class="container mt-5">
    <h1 class="mb-4">{{$title}}</h1>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Fecha de Descuento</th>
                <th>Acción</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $billfold)
                <tr>
                    <td>{{ $billfold->name}}</td>
                    <td>{{ substr($billfold->discount_date,0,10) }}</td>
                    <td class="d-flex justify-content-center">
                        <a class="me-3" href="{{route('showBills', $billfold->id)}}"><button type="button" class="btn btn-primary"><i class="fa-regular fa-folder-open"></i></button></a>
                        <form action="{{ route('billfold.destroy', $billfold->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este ítem?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
{{--        <button type="submit" class="btn btn-primary">Calcular</button>--}}
    <a href="{{route('addBillfold')}}"><button type="button" class="btn add"><i class="fa-solid fa-plus"></i></button></a>

    @if(session('message'))
        <div class="alert alert-success mt-3">
            {{ session('message') }}
        </div>
    @endif

{{--        <a href="{{route('addBill', $data['billfold']['id'])}}"><button type="button" class="btn btn-primary">Agregar</button></a>--}}
</div>


@endsection





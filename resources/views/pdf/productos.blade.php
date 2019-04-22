@extends('adminlte::layouts.app')

@section('content')
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Descripción</th>
                <th>Stock</th>
            </tr>                            
        </thead>
        <tbody>
            @foreach($productos as $producto)
            <tr>
                <td>{{ $producto->id }}</td>
                <td>{{ $producto->barcode }}</td>
                <td>{{ $producto->description }}</td>
                <td class="text-right">{{ $producto->stock }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
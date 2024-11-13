@extends('layouts.main')

@section('title', 'HDC Events')

@section('content')



<p>Produtos: </p>

@if ($busca != '')
    <p>o usuario esta buscando por {{ $busca }}</p>
@endif


@endsection
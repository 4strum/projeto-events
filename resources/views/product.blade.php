@extends('layouts.main')

@section('title', 'HDC Events')

@section('content')



@if ($id != null)
    <p> Produto de id = {{ $id }}</p>
@else
    <p>Não ha produtos</p>
@endif


@endsection
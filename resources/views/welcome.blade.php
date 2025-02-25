@extends('layouts.main')

@section('title', 'HDC Events')

@section('content')


<div id="search-container" class="col-md-12">
    <h1>Busque um evento</h1>
    <form action="/" method="GET">
        <input type="text" id="search" name="search" class="form-control" placeholder="procurar por evento">
    </form>
</div>
<div id="events-container" class="col-md-12"> 
    @if ($search)
    <h2>Buscando por: {{ $search }}</h2>
    @else
    <h2>Proximos eventos</h2>
    @endif
    <p class="subtitle">Veja os eventos dos próximos dias</p>
    <div id="cards-containers" class="row">
        @foreach($events as $event)
            <div class="card col-md-3">
                <img src="img/events/{{ $event->image }}" alt="{{ $event->title }}">
                <div class="card-body">
                    <p class="card-date">{{ date('d/m/Y', strtotime($event->date)) }}</p>
                    <h5 class="card-title"> {{ $event->title }}</h5>
                    <p class="card-participants">{{ count($event->users) }} participantes</p>
                    <a href="/events/{{ $event->id }}" class="btn btn-primary">Saber mais</a>
                </div>
            </div>
        @endforeach
        @if (count($events) == 0 && $search )
            <p class="subtitle">Nenhum evento com {{ $search }}, Clique<a href="/" > aqui </a> para ver todos</p>
        @elseif (count($events) == 0)
            <p class="subtitle">Nenhum evento encontrado</p>
        @endif

      
    </div>
</div>

@endsection
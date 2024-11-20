@extends('layouts.main')

@section('title', 'HDC Events')

@section('content')


<div id="search-container" class="col-md-12">
    <h1>Busque um evento</h1>
    <form action="">
        <input type="text" id="search" name="search" class="form-control" placeholder="procurar por evento">
    </form>
</div>
<div id="events-container" class="col-md-12"> 
    <h2>Próximos eventos</h2>
    <p class="subtitle">Veja os eventos dos próximos dias</p>
    <div id="cards-containers" class="row">
        @foreach($events as $event)
            <div class="card col-md-3">
                <img src="img/events/{{ $event->image }}" alt="{{ $event->title }}">
                <div class="card-body">
                    <p class="card-date">17/11/2024</p>
                    <h5 class="card-title"> {{ $event->title }}</h5>
                    <p class="card-participants">x participantes</p>
                    <a href="" class="btn btn-primary">Saber mais</a>
                </div>
            </div>
        @endforeach

    </div>
</div>

@endsection
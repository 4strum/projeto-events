@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <h1>Meus Eventos</h1>
    </div>

    <div class="col-md-10 offset-md-1 dashboard-events-container">
        @if (count($events) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Participantes</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($events as $event)
                        <td>{{ $loop->index + 1 }}</td>
                        <td><a href="/events/{{ $event->id }}">{{ $event->title }}</a></td>
                        <td>{{ count($event->users) }}</td>
                        <td>
                            <a href="/events/edit/{{ $event->id }}" class="btn btn-info edit-btn"><ion-icon
                                    name="create-outline"></ion-icon> Editar</a>
                            <form action="{{ route('events.destroy', $event->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger delete-btn">
                                    <ion-icon name="trash-outline"></ion-icon>Deletar
                                </button>
                            </form>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Você ainda não tem nenhum evento, <a href="/events/create">criar evento</a></p>
        @endif




        <h1>Eventos que estou participando</h1>



        @if(count($eventsAsParticipantes ?? []) > 0)

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Participantes</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($eventsAsParticipantes as $event)
                        <td>{{ $loop->index + 1 }}</td>
                        <td><a href="/events/{{ $event->id }}">{{ $event->title }}</a></td>
                        <td>{{ count($event->users) }}</td>
                        <td>
                           <form action="/events/leave/{{ $event->id }}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger delete-btn">
                                    <ion-icon name="trash-outline"></ion-icon>
                                    sair do evento
                                </button>
                           </form>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Você ainda nao esta participando de nenhum evento, <a href="/">veja os eventos!</a></p>
        @endif
    </div>
    </div>
@endsection
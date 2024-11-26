@extends('layouts.main')

@section('title', 'Criar um evento')

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Crie seu evento</h1>
    <form action="/events" method="POST" enctype="multipart/form-data"> 
        @csrf
        <div class="form-group">
            <label for="image">Imagem do Evento:</label>
            <input type="file" id="image" name="image" class="form-control-file">
        </div>
        <div class="form-group">
            <label for="title">Evento:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Nome do evento">
        </div>
        <div class="form-group">
            <label for="title">Data do Evento:</label>
            <input type="date" class="form-control" id="date" name="date">
        </div>
        <div class="form-group">
            <label for="city">Cidade:</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="Local do evento">
        </div>
        <div class="form-group">
            <label for="private">O evento é privado?</label>
            <select name="private" id="private" class="form-control">
                <option value="0">Não</option>
                <option value="1">Sim</option>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Evento:</label>
            <textarea name="description" id="description" class="form-control" placeholder="O que vai acontecer no evento?"></textarea>
        </div>
        <div class="form-group">
            <label for="items">Adicione itens de infraestrutura: </label>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Cadeiras"> Cadeiras <br>
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Palco"> Palco <br>
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Cerveja grátis"> Cerveja grátis <br>
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Open Food"> Open Food <br>
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Brindes"> Brindes <br>
            </div>
        </div>

        <input type="submit" class="btn btn-primary" value="criar evento">
    </form>
</div>

@endsection
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\User;

class EventController extends Controller
{

    public function index()
    {

        $search = request("search");

        if ($search) {
            $events = Event::where([
                ["title", "like", "%" . $search . "%"]
            ])->get();
        } else {
            //pegar todas as informações da tabela
            $events = Event::all();
        }


        return view('welcome', ['events' => $events, 'search' => $search]);
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {

        $event = new Event;

        $event->title = $request->title;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;
        $event->items = $request->items;
        $event->date = $request->date;

        // Image Upload
        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/events'), $imageName);

            $event->image = $imageName;



        }
        $user = auth()->user();
        $event->user_id = $user->id;

        $event->save();

        return redirect('/')->with('msg', 'evento criado com sucesso');
    }

    public function show($id)
    {
        $event = Event::find($id);

        $user = auth()->user();
        $hasUserJoined = false;

        if($user){

            $userEvents = $user->eventsAsParticipantes->toArray();
            foreach($userEvents as $userEvent){
                if($userEvent['id'] == $id){
                    $hasUserJoined = true;
                }
            }
        }

        $eventOwner = User::where('id', $event->user_id)->first()->toArray();

        return view('events.show', ['event' => $event, 'eventOwner' => $eventOwner,  'hasUserJoined' =>  $hasUserJoined]);
    }

    public function dashboard()
    {
        $user = auth()->user();

        // Carregar eventos em que o usuário é o organizador
        $events = $user->events;

        // Carregar eventos nos quais o usuário é participante
        $eventsAsParticipantes = $user->eventsAsParticipantes; // Aqui não usa os parênteses

        return view('events.dashboard', ['events' => $events, 'eventsAsParticipantes' => $eventsAsParticipantes]);
    }
    public function destroy($id)
    {
        Event::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg', 'Evento excluido com sucesso!!');
    }

    public function edit($id)
    {

        $user = auth()->user();

        $event = Event::findOrFail($id);

        if ($user->id != $event->user->id) {
            return redirect('/dashboard');
        }

        return view('events.edit', ['event' => $event]);
    }   

    public function update(Request $request)
    {

        $data = $request->all();

        // Image Upload
        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/events'), $imageName);

            $data['image'] = $imageName;

        }

        Event::findOrFail($request->id)->update($data);

        return redirect('/dashboard')->with('msg', 'Evento editado com sucesso!');

    }

    public function joinEvent($id)
    {
        $user = auth()->user();

        // Verifica se o usuário já está participando do evento para evitar duplicidade
        if ($user->eventsAsParticipantes()->where('event_id', $id)->exists()) {
            return redirect()->back()->with('msg', 'Você já está participando deste evento.');
        }

        // Adiciona o usuário como participante do evento
        $user->eventsAsParticipantes()->attach($id);

        $event = Event::findOrFail($id);

        // Redireciona o usuário com uma mensagem de sucesso
        return redirect('/dashboard')->with('msg', 'Sua presença está confirmada no evento ' . $event->title);
    }

    public function leaveEvent($id){

        $user = auth()->user();

        $user->eventsAsParticipantes()->detach($id);

        $event = Event::findOrFail($id);
        
        return redirect('/dashboard')->with('msg', 'Você saiu com sucesso do evento:  ' . $event->title);
    }

}

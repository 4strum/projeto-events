<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;

class EventController extends Controller
{
    
    public function index(){

        $search = request("search");

        if($search){
            $events = Event::where([
                ["title","like","%".$search."%"]
            ])->get();
        }else{
            //pegar todas as informações da tabela
            $events = Event::all();
        }
       
    
        return view('welcome',['events' => $events, 'search'  => $search]);
    }

    public function create(){
        return view('events.create');
    }

    public function store(Request $request){
        
        $event = new Event;

        $event->title = $request->title;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;
        $event->items = $request->items;
        $event->date = $request->date;
        
   // Image Upload
   if($request->hasFile('image') && $request->file('image')->isValid()) {

    $requestImage = $request->image;

    $extension = $requestImage->extension();

    $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

    $requestImage->move(public_path('img/events'), $imageName);

    $event->image = $imageName;

  

}

        $event->save();

        return redirect('/')->with('msg', 'evento criado com sucesso');
    }

    public function show($id){
        $event = Event::find($id);
        
        return view('events.show', ['event' => $event]);
    }
}

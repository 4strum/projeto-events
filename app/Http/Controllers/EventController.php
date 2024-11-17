<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;

class EventController extends Controller
{
    
    public function index(){
        //pegar todas as informações da tabela
        $events = Event::all();
        
        return view('welcome',['events' => $events]);
    }

    public function create(){
        return view('events.create');
    }


}

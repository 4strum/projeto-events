<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    
    public function index(){
        $nome = "Joao";
        $idade = 20;
    
        $arr = [1,2,3,4,5,6,7];
    
        $nomes = ['joao', 'pedro', 'borges'];
    
        return view('welcome',
            [
                'nome' => $nome,
                'idade' => $idade,
                'profissao' => 'Programador',
                'arr' => $arr,
                'nomes' => $nomes
            ]);
    }

    public function create(){
        return view('events.create');
    }


}

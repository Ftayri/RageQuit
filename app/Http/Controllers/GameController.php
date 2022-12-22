<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function details($id){
        $game=Game::where('id',$id)->get();
        return view('game.details',compact('game'));
    }
}

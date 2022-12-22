<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Game;

class HomeController extends Controller
{
   function index(){
    $games=Game::all()->take(10);
    return view('home',compact('games'));
   }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Game;

class HomeController extends Controller
{
   function index(){
   //get 10 highest rating games
   $games=Game::orderBy('average_rating','desc')->take(10)->get();
    return view('home',compact('games'));
   }
}

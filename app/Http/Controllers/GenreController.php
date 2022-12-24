<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class GenreController extends Controller
{
    public function games(Request $request, $id){
        $genre=Genre::find($id);
        $games=$genre->games;
        $totalGames=count($games);
        $page=$request->query('page',1);
        $games= $this->paginate($games, 5, $page);
        return view('game.index',compact('games','page','totalGames','genre'));
    }
    function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

}

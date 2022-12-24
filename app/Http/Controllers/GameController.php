<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class GameController extends Controller
{
    public function details(Request $request, $id){
        //get the first game with the id
        $game=Game::where('id',$id)->first();
        //get the game publishers to $gamePublishers
        $gamePublishers=$game->gamePublishers;
        //iterate over $gamePublishers and get the gamePlatforms    
        foreach($gamePublishers as $gamePublisher){
            $gamePlatforms[]=$gamePublisher->gamePlatforms;
        }
        $releaseYear=10000;
        foreach($gamePlatforms as $platforms){
            foreach($platforms as $platform){
                if($platform->release_year<$releaseYear){
                    $releaseYear=$platform->release_year;
                }
            }
        }
        $similarGames=$game->genre->games;
        $totalGames=count($similarGames);
        $page=$request->query('page',1);
        $similarGames= $this->paginator($similarGames, 5, $page);
        return view('game.details',compact('game','gamePublishers','gamePlatforms','releaseYear','similarGames','page'));
    }
    public function index(Request $request){
        $page=$request->query('page');
        $totalGames=Game::count();
        $games=Game::paginate(5,['*'],'page',$page);
        return view('game.index',compact('games','page','totalGames'));
    }
    public function paginator($items, $perPage = 5, $page = null, $options = [])
    {
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

}

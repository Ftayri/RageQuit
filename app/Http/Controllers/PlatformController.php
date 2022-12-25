<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Platform;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PlatformController extends Controller
{
    public function games(Request $request, $id){
        $platform=Platform::find($id);
        $gamePlatforms=$platform->gamePlatforms;
        foreach($gamePlatforms as $gamePlatform){
           $gamePublishers[]=$gamePlatform->gamePublisher;
        }
        foreach($gamePublishers as $gamePublisher){
            $games[]=$gamePublisher->game;
        }
        $totalGames=count($games);
        $page=$request->query('page',1);
        $games= $this->paginate($games, 5, $page);
        return view('game.index',compact('games','page','totalGames','platform'));
    }
    function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}

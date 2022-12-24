<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publisher;

use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PublisherController extends Controller
{
    public function details(Request $request, $id){
        $publisher=Publisher::where('id',$id)->first();
        $gamePublishers=$publisher->gamePublishers;
        foreach($gamePublishers as $gamePublisher){
            $gamePlatforms[]=$gamePublisher->gamePlatforms;
            $games[]=$gamePublisher->game;
        }
        foreach($gamePlatforms as $platforms){
            foreach($platforms as $platform){
                $platformNames[]=$platform->platform->platform_name;
            }
        }
        $platformNames=array_unique($platformNames);
        $totalGames=count($games);
        $page=$request->query('page',1);
        $games= $this->paginate($games, 5, $page);
        return view('publisher.details',compact('publisher','games','platformNames','totalGames','page'));
    }

    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}

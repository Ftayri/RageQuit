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
        $games=$platformNames=[];
        $totalGames=0;
        $page=$request->query('page',1);
        if(!$publisher->gamePublishers->isEmpty()){
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
            $games= $this->paginate($games, 5, $page);
        }
        return view('publisher.details',compact('publisher','games','platformNames','totalGames','page'));
    }

    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
    public function create(){
        return view('publisher.create');
    }
    public function store(Request $request){
        $request->validate([
            'publisher_name'=>['required','string','max:255','unique:publishers'],
            'photo'=>['nullable','image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'description'=>['nullable','string'],
            'website_link'=>['nullable','url'],
            'twitter_link'=>['nullable','url'],
        ]);
        $publisher=new Publisher();
        $publisher->publisher_name=$request->input('publisher_name');
        $publisher->description=$request->input('description');
        $publisher->website_link=$request->input('website_link');
        $publisher->twitter_link=$request->input('twitter_link');
        if($request->file('photo')){
            $photo=$request->file('photo');
            $photoName=time().'.'.$photo->getClientOriginalExtension();
            $photo->move(public_path('images/publishers'),$photoName);
            $publisher->photo=$photoName;
        }
        $publisher->save();
        return redirect()->route('publisher.details',['id'=>$publisher->id]);
    }
    public function edit(Request $request, $id){
        $publisher=Publisher::where('id',$id)->first();
        return view('publisher.edit',compact('publisher'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'publisher_name'=>['required','string','max:255','unique:publishers,publisher_name,'.$id],
            'photo'=>['nullable','image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'description'=>['nullable','string'],
            'website_link'=>['nullable','url'],
            'twitter_link'=>['nullable','url'],
        ]);
        $publisher=Publisher::where('id',$id)->first();
        $publisher->publisher_name=$request->input('publisher_name');
        $publisher->description=$request->input('description');
        $publisher->website_link=$request->input('website_link');
        $publisher->twitter_link=$request->input('twitter_link');
        if($request->file('photo')){
            $photo=$request->file('photo');
            $photoName=time().'.'.$photo->getClientOriginalExtension();
            $photo->move(public_path('images/publishers'),$photoName);
            $publisher->photo=$photoName;
        }
        $publisher->save();
        return redirect()->route('publisher.details',['id'=>$publisher->id]);
    }
}

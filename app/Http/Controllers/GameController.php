<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Publisher;
use App\Models\Platform;
use App\Models\Genre;
use App\Models\GamePublisher;
use App\Models\GamePlatform;
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
        $firstReview=$game->gameUsers->where('review','!=',null)->first();
        $totalReviews=$game->gameUsers->where('review','!=',null)->count();
        $similarGames=$game->genre->games;
        $totalGames=count($similarGames);
        $page=$request->query('page',1);
        $similarGames= $this->paginator($similarGames, 5, $page);
        return view('game.details',compact('game','gamePublishers','gamePlatforms','releaseYear','similarGames','page','totalReviews','firstReview'));
    }
    public function index(Request $request){
        $page=$request->query('page',1);
        $sort=$request->query('sort','top');
        $totalGames=Game::count();
        if($sort=='top'){
            $games=Game::orderBy('average_rating','desc')->paginate(5,['*'],'page',$page);
        }
        else if($sort=='bot'){
            $games=Game::orderBy('average_rating','asc')->paginate(5,['*'],'page',$page);
        }
        return view('game.index',compact('games','page','totalGames'));

    }
    public function reviews(Request $request,$id){
        $game=Game::where('id',$id)->first();
        $gameUsers=$game->gameUsers->where('review','!=',null);
        $totalReviews=$gameUsers->count();
        $page=$request->query('page',1);
        $gameUsers= $this->paginator($gameUsers, 5, $page);
        return view('game.reviews',compact('gameUsers','page','totalReviews','game'));
    }
    public function search(Request $request){
        $search=$request->input('search');
        $page=$request->query('page',1);
        $games=Game::where('game_name','like','%'.$search.'%')->paginate(5,['*'],'page',$page);
        $totalGames=$games->total();
        return view('game.index',compact('games','page','totalGames','search'));
    }
    public function paginator($items, $perPage = 5, $page = null, $options = [])
    {
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
    public function create(){
        $publishers=Publisher::all();
        $platforms=Platform::all();
        $genres=Genre::all();
        return view('game.create',compact('publishers','platforms','genres'));
    }
    public function store(Request $request){
        $game=new Game();
        $request->validate([
            'game_name'=>['required','string','max:255','unique:games'],
            'photo'=>['nullable','image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'background_image'=>['nullable','image', 'mimes:jpeg,png,jpg,gif,svg', 'max:4096'],
            'description'=>['nullable','string'],
            'website_link'=>['nullable','url'],
            'steam_link'=>['nullable','url'],
            'trailer_link'=>['nullable','url'],
            'genre_id'=>['required'],
            'platform_id'=>['required','array','min:1'],
            'platform_id.*'=>['required','integer','exists:platforms,id'],
            'publisher_id'=>['required','array','min:1'],
            'publisher_id.*'=>['required','integer','exists:publishers,id'],
            'release_year'=>['required','array','min:1'],
            'release_year.*'=>['required','integer','min:1900','max:'.date('Y')],
        ]);
        $game->game_name=$request->input('game_name');
        $game->description=$request->input('description');
        $game->website_link=$request->input('website_link');
        $game->steam_link=$request->input('steam_link');
        $game->trailer_link=$request->input('trailer_link');
        $game->genre_id=$request->input('genre_id');
        if($request->hasFile('photo')){
            $photo=$request->file('photo');
            $photoName=time().'.'.$photo->getClientOriginalExtension();
            $photo->move(public_path('images/games'),$photoName);
            $game->photo=$photoName;
        }
        if($request->hasFile('background_image')){
            $backgroundImage=$request->file('background_image');
            $backgroundImageName=time().'.'.$backgroundImage->getClientOriginalExtension();
            $backgroundImage->move(public_path('images/backgrounds'),$backgroundImageName);
            $game->background_image=$backgroundImageName;
        }
        $game->average_rating=0;
        $game->save();
        $publishers=$request->input('publisher_id');
        $platforms=$request->input('platform_id');
        $releaseYears=$request->input('release_year');
        for($i=0;$i<count($publishers);$i++){
            $gamePublisher=new GamePublisher();
            $gamePublisher->game_id=$game->id;
            $gamePublisher->publisher_id=$publishers[$i];
            $gamePublisher->save();
            $gamePlatform=new GamePlatform();
            $gamePlatform->game_publisher_id=$gamePublisher->id;
            $gamePlatform->platform_id=$platforms[$i];
            $gamePlatform->release_year=$releaseYears[$i];
            $gamePlatform->save();
        }
        
        return redirect()->route('game.details',['id'=>$game->id]);
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GameUser;
use App\Models\Game;

class GameUserController extends Controller
{
    public function create(Request $request){
        //check if user is authenticated
        if(auth()->check()){
            //check if user has already added game to their list
            $gameUser = GameUser::where('user_id',auth()->user()->id)->where('game_id',$request->input('game_id'))->first();
            if($gameUser){
                //if user has already added game to their list, delete it
                //update game's rating
                $gameUser->delete();
                $game=Game::where('id',$request->input('game_id'))->first();
                //get game's gameUsers where review isn't null
                $gameUsers=$game->gameUsers->where('review','!=',null);
                $game->average_rating=round($gameUsers->avg('rating'),1);
                $totalUsers=$game->gameUsers->where('rating','!=',NULL)->count();
                $game->save();
                return response()->json(['average_rating'=>$game->average_rating, 'total_reviews'=> $totalUsers,'success'=>'Successfully removed game from your list']);
            }else{
                //if user has not added game to their list, add it
                $gameUser=new GameUser();
                $gameUser->user_id=auth()->user()->id;
                $gameUser->game_id=$request->input('game_id');
                $gameUser->rating=0;
                $gameUser->save();
                return response()->json(['success'=>'Successfully added game to your list']);
            }
        }
        return response()->json(['success'=>'User not logged in']);
    }

    public function profile(Request $request){
        if(auth()->check()){
            //get all games added by user
            $page=$request->query('page',1);
            $totalGames=GameUser::where('user_id',auth()->user()->id)->count();
            $userGames=GameUser::where('user_id',auth()->user()->id)->paginate(20,['*'],'page',$page);
            //paginate userGames
            return view('user.profile',compact('userGames','page','totalGames'));
        }
        return redirect()->back();
    }
    
    public function update(Request $request){
        if(auth()->check()){
            $gameUser=GameUser::where('user_id',auth()->user()->id)->where('game_id',$request->input('game_id'))->first();
            if($gameUser){
                //validate rating and review
                $request->validate([
                    'rating'=>'required|numeric|min:0|max:10',
                    'review'=>'required|string'
                ]);
                $game=$gameUser->game;
                //get total users who have rated the game
                //check if authenticated user already rated the game
                $newRating=$request->input('rating');
                $gameUser->rating=$newRating;
                $gameUser->review=$request->input('review');
                $gameUser->save();
                $gameUsers=$game->gameUsers->where('review','!=',null);
                $game->average_rating=round($gameUsers->avg('rating'),1);
                $game->save();
                $totalUsers=$game->gameUsers->where('rating','!=',NULL)->count();
                return response()->json(['average_rating'=>$game->average_rating, 'total_reviews'=> $totalUsers, 'success'=>'Successfully updated game rating and review']);
            }
            return response()->json(['error'=>'Game not found']);
        }
        return response()->json(['error'=>'User not logged in']);
    }
}

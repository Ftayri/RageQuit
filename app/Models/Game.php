<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $genre_id
 * @property string $game_name
 * @property string $photo
 * @property GamePublisher[] $gamePublishers
 * @property Genre $genre
 */
class Game extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['genre_id', 'game_name', 'photo'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gamePublishers()
    {
        return $this->hasMany('App\Models\GamePublisher');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function genre()
    {
        return $this->belongsTo('App\Models\Genre');
    }

    public function gameUsers(){
        return $this->hasMany('App\Models\GameUser');
    }
}

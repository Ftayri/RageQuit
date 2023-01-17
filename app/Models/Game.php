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
 * @property GameUser[] $gameUsers
 * @property float $average_rating
 * @property string $description
 * @property string $steam_link
 * @property string $website_link
 * @property string $trailer_link
 * @property string $background_image
 */
class Game extends Model
{
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = ['genre_id', 'game_name', 'photo', 'average_rating', 'description', 'steam_link', 'website_link', 'trailer_link', 'background_image'];

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

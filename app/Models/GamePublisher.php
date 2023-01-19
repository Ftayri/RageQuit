<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $game_id
 * @property integer $publisher_id
 * @property GamePlatform[] $gamePlatforms
 * @property Game $game
 * @property Publisher $publisher
 */
class GamePublisher extends Model
{
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = ['game_id', 'publisher_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gamePlatforms()
    {
        return $this->hasMany('App\Models\GamePlatform');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function game()
    {
        return $this->belongsTo('App\Models\Game');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function publisher()
    {
        return $this->belongsTo('App\Models\Publisher');
    }
}

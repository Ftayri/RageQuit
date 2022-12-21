<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $game_publisher_id
 * @property integer $platform_id
 * @property integer $release_year
 * @property GamePublisher $gamePublisher
 * @property Platform $platform
 * @property RegionSale[] $regionSales
 */
class GamePlatform extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['game_publisher_id', 'platform_id', 'release_year'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gamePublisher()
    {
        return $this->belongsTo('App\Models\GamePublisher');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function platform()
    {
        return $this->belongsTo('App\Models\Platform');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function regionSales()
    {
        return $this->hasMany('App\Models\RegionSale');
    }
}

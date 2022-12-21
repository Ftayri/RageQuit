<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $region_id
 * @property integer $game_platform_id
 * @property float $num_sales
 * @property GamePlatform $gamePlatform
 * @property Region $region
 */
class RegionSales extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['region_id', 'game_platform_id', 'num_sales'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gamePlatform()
    {
        return $this->belongsTo('App\Models\GamePlatform');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function region()
    {
        return $this->belongsTo('App\Models\Region');
    }
}

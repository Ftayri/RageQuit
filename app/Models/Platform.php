<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $platform_name
 * @property GamePlatform[] $gamePlatforms
 */
class Platform extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['platform_name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gamePlatforms()
    {
        return $this->hasMany('App\Models\GamePlatform');
    }
}

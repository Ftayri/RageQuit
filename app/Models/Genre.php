<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $genre_name
 * @property Game[] $games
 */
class Genre extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['genre_name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function games()
    {
        return $this->hasMany('App\Models\Game');
    }
}

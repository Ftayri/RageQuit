<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $publisher_name
 * @property GamePublisher[] $gamePublishers
 */
class Publisher extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['publisher_name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gamePublishers()
    {
        return $this->hasMany('App\Models\GamePublisher');
    }
}

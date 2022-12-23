<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $publisher_name
 * @property GamePublisher[] $gamePublishers
 * @property string $photo
 * @property string $description
 */
class Publisher extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['publisher_name', 'photo', 'description'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gamePublishers()
    {
        return $this->hasMany('App\Models\GamePublisher');
    }
}

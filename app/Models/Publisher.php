<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $publisher_name
 * @property GamePublisher[] $gamePublishers
 * @property string $photo
 * @property string $description
 * @property string $twitter_link
 * @property string $website_link
 */
class Publisher extends Model
{
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = ['publisher_name', 'photo', 'description', 'twitter_link', 'website_link'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gamePublishers()
    {
        return $this->hasMany('App\Models\GamePublisher');
    }
}

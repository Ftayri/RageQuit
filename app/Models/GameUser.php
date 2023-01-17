<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $user_id
 * @property integer $game_id
 * @property float $rating
 * @property string $review
 */
class GameUser extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable=['rating','review'];

    /**
     * Get the game that owns the GameUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function game()
    {
        return $this->belongsTo('App\Models\Game');
    }
    
    /**
     * Get the user that owns the GameUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}

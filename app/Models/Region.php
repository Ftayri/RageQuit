<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $region_name
 * @property RegionSale[] $regionSales
 */
class Region extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['region_name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function regionSales()
    {
        return $this->hasMany('App\Models\RegionSale');
    }
}

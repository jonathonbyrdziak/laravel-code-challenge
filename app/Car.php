<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Car extends Model
{
    protected $fillable = ['make', 'model', 'year', 'owner_id', 'address_id'];
    
    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo('App\Owner');
    }
    
    /**
     * Get addresses associated with a car.
     *
     * @return HasOne
     */
    public function addresses(): HasOne
    {
        return $this->hasOne(Address::class);
    }

    public function getTypes(): array
    {
        return json_decode(file_get_contents(storage_path() . '/json/car-data.json'), true);
    }
}

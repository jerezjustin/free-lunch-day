<?php

namespace App\Models;

use App\Events\IngredientQuantityUpdated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ingredient extends Model
{
    use HasFactory;

    protected $dispatchesEvents = [
        'updated' => IngredientQuantityUpdated::class,
    ];

    protected $fillable = [
        'name',
        'quantity',
    ];

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }

    public function recipes(): BelongsToMany
    {
        return $this->belongsToMany(Recipe::class)->withPivot('quantity');
    }
}

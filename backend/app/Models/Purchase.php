<?php

namespace App\Models;

use App\Events\NewIngredientPurchase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Purchase extends Model
{
    use HasFactory;

    protected $dispatchesEvents = [
        'created' => NewIngredientPurchase::class,
    ];

    protected $fillable = [
        'quantity',
        'ingredient_id',
    ];

    public function ingredient(): BelongsTo
    {
        return $this->belongsTo(Ingredient::class);
    }
}

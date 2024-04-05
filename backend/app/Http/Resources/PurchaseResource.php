<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'quantity' => $this->quantity,
            'created_at' => $this->created_at,
            'ingredient' => [
                'id' => $this->ingredient_id,
                'name' => $this->ingredient->name,
            ],
        ];
    }
}

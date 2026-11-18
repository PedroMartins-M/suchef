<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RecipeStep extends Model
{
    protected $fillable = [
        'recipe_id',
        'step_number',
        'instruction',
        'image',
    ];

    protected function casts(): array
    {
        return [
            'step_number' => 'integer',
        ];
    }

    // Receita à qual esta etapa pertence
    public function recipe(): BelongsTo
    {
        return $this->belongsTo(Recipe::class);
    }
}
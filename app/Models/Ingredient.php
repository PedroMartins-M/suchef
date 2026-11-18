<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ingredient extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    // Receitas que utilizam este ingrediente
    public function recipes(): BelongsToMany
    {
        return $this->belongsToMany(
            Recipe::class,
            'recipe_ingredients'
        )
            ->withPivot('quantity', 'unit')
            ->withTimestamps();
    }
}
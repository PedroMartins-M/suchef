<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Recipe extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'description',
        'image',
        'preparation_time',
        'cooking_time',
        'servings',
        'difficulty',
        'status',
        'visibility',
    ];

    protected function casts(): array
    {
        return [
            'preparation_time' => 'integer',
            'cooking_time' => 'integer',
            'servings' => 'integer',
        ];
    }

    // Usuário responsável pela receita
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Categoria da receita
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Ingredientes utilizados na receita
    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(
            Ingredient::class,
            'recipe_ingredients'
        )
            ->withPivot('quantity', 'unit')
            ->withTimestamps();
    }

    // Etapas de preparo
    public function steps(): HasMany
    {
        return $this->hasMany(RecipeStep::class)
            ->orderBy('step_number');
    }
}
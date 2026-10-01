<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

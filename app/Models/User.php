<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'avatar',
        'bio',
        'level',
        'xp',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

   protected function casts(): array
{
    return [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'level' => 'integer',
        'xp' => 'integer',
        'preferences' => 'array',
    ];
}

    public function recipes(): HasMany
    {
        return $this->hasMany(Recipe::class);
    }
}
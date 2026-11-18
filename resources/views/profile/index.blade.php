@extends('layouts.app')

@section('title', 'Meu perfil | SuChef')

@section('content')
<div class="app-layout">
    @include('components.sidebar')

    <main class="app-main">
        <div class="topbar">
            <span class="page-eyebrow">MINHA COZINHA</span>
            <a href="{{ route('recipes.create') }}" class="topbar-button">
                + Nova receita
            </a>
        </div>

        <section class="profile-page">
            <div class="profile-header">
                <div class="profile-avatar">
                    @if($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="Foto de perfil">
                    @else
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    @endif
                </div>

                <div class="profile-identity">
                    <span class="page-eyebrow">CHEF DA COMUNIDADE</span>
                    <h1>{{ $user->name }}</h1>
                    <p class="profile-username">
                        {{ '@' . $user->username }}
                    </p>

                    <p class="profile-bio">
                        {{ $user->bio ?: 'Este chef ainda não adicionou uma biografia.' }}
                    </p>
                </div>
            </div>

            <div class="profile-stats">
                <div>
                    <strong>{{ $recipeCount }}</strong>
                    <span>Receitas</span>
                </div>

                <div>
                    <strong>{{ $user->level }}</strong>
                    <span>Nível</span>
                </div>

                <div>
                    <strong>{{ $user->xp }}</strong>
                    <span>XP</span>
                </div>
            </div>

            <div class="profile-recipes">
                <div class="profile-section-heading">
                    <div>
                        <span class="page-eyebrow">SUAS CRIAÇÕES</span>
                        <h2>Minhas receitas</h2>
                    </div>
                </div>

                @if($recipes->isEmpty())
                    <div class="empty-recipes">
                        <span>🍳</span>
                        <h3>Sua cozinha ainda está vazia</h3>
                        <p>Que tal compartilhar sua primeira criação?</p>
                        <a href="{{ route('recipes.create') }}">
                            Criar primeira receita
                        </a>
                    </div>
                @else
                    <div class="recipes-grid">
                        @foreach($recipes as $recipe)
                            <a href="{{ route('recipes.show', $recipe->slug) }}" class="recipe-card">
                                <div class="recipe-image">
                                    @if($recipe->image)
                                        <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}">
                                    @else
                                        <span>SuChef</span>
                                    @endif
                                </div>

                                <div class="recipe-info">
                                    <h3>{{ $recipe->title }}</h3>
                                    <p>{{ Str::limit($recipe->description, 90) }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>
    </main>
</div>
@endsection

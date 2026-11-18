@extends('layouts.app')

@section('title', $recipe->title . ' | SuChef')

@section('content')

<div class="app-layout">

    @include('components.sidebar')

    <main class="app-main recipe-detail-page">

        <header class="topbar">
            <span>SuChef / Receitas / {{ $recipe->title }}</span>

            <a href="{{ route('recipes.index') }}" class="topbar-button">
                Voltar às receitas
            </a>
        </header>

        <a href="{{ route('recipes.index') }}" class="recipe-back-link">
            ← Voltar para explorar
        </a>

        <section class="recipe-detail-hero">

            <div class="recipe-detail-image">
                @if($recipe->image)
                    <img
                        src="{{ asset('storage/' . $recipe->image) }}"
                        alt="{{ $recipe->title }}"
                    >
                @else
                    <div class="recipe-no-image">
                        <span>SuChef</span>
                        <p>Esta receita ainda não possui imagem.</p>
                    </div>
                @endif
            </div>

            <div class="recipe-detail-info">

                <span class="recipe-category">
                    {{ $recipe->category->name ?? 'Sem categoria' }}
                </span>

                <h1>{{ $recipe->title }}</h1>

                <p class="recipe-detail-description">
                    {{ $recipe->description ?? 'Uma receita para experimentar e compartilhar.' }}
                </p>

                <div class="recipe-detail-meta">

                    <div>
                        <strong>
                            {{ ($recipe->preparation_time ?? 0) + ($recipe->cooking_time ?? 0) }} min
                        </strong>
                        <span>Tempo total</span>
                    </div>

                    <div>
                        <strong>{{ $recipe->servings }}</strong>
                        <span>Porções</span>
                    </div>

                    <div>
                        <strong>
                            @switch($recipe->difficulty)
                                @case('easy') Fácil @break
                                @case('medium') Médio @break
                                @case('hard') Difícil @break
                                @default Não informado
                            @endswitch
                        </strong>
                        <span>Dificuldade</span>
                    </div>

                </div>

                <p class="recipe-detail-author">
                    Receita publicada por
                    <strong>{{ $recipe->user->name ?? 'Usuário SuChef' }}</strong>
                </p>

                <a href="#modo-preparo" class="btn-primary recipe-start-button">
                    Começar a preparar
                </a>

            </div>

        </section>

        <section class="recipe-detail-section">

            <div class="recipe-detail-section-heading">
                <span>01</span>
                <div>
                    <h2>Ingredientes</h2>
                    <p>Tudo o que você vai precisar.</p>
                </div>
            </div>

            <ul class="recipe-detail-ingredients">

                @forelse($recipe->ingredients as $ingredient)
                    <li>
                        <span class="ingredient-check">✓</span>

                        <span>{{ $ingredient->name }}</span>

                        <strong>
                            @if($ingredient->pivot->quantity)
                                {{ $ingredient->pivot->quantity }}
                            @endif

                            {{ $ingredient->pivot->unit }}
                        </strong>
                    </li>
                @empty
                    <li>Nenhum ingrediente cadastrado.</li>
                @endforelse

            </ul>

        </section>

        <section class="recipe-detail-section" id="modo-preparo">

            <div class="recipe-detail-section-heading">
                <span>02</span>
                <div>
                    <h2>Modo de preparo</h2>
                    <p>Siga cada etapa para preparar sua receita.</p>
                </div>
            </div>

            <ol class="recipe-detail-steps">

                @forelse($recipe->steps as $step)
                    <li>
                        <span class="step-number">
                            {{ $step->step_number }}
                        </span>

                        <div>
                            <p>{{ $step->instruction }}</p>
                        </div>
                    </li>
                @empty
                    <li>Esta receita ainda não possui etapas cadastradas.</li>
                @endforelse

            </ol>

        </section>

    </main>

</div>

@endsection

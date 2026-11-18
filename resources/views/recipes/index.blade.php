@extends('layouts.app')

@section('title', 'Explorar receitas — SuChef')

@section('content')

<div class="app-layout">

    @include('components.sidebar')

    <main class="app-main">

        <header class="topbar">
            <span>SuChef / Explorar receitas</span>

            <a href="{{ route('recipes.create') }}" class="topbar-button">
                + Nova receita
            </a>
        </header>

        <section class="page-heading">
            <span class="eyebrow">DESCUBRA NOVOS SABORES</span>

            <h1>
                Explorar receitas<span>.</span>
            </h1>

            <p>
                Encontre algo novo para preparar, compartilhe suas
                criações e descubra receitas da comunidade.
            </p>
        </section>

        <form action="{{ route('recipes.index') }}" method="GET"
              class="recipe-search">

            <input
                type="text"
                name="q"
                placeholder="Buscar receitas..."
                value="{{ request('q') }}"
            >

            @if(request('category'))
                <input type="hidden" name="category"
                       value="{{ request('category') }}">
            @endif

            <button type="submit">Buscar</button>
        </form>

        <div class="categories">

            <a
                href="{{ route('recipes.index', ['q' => request('q')]) }}"
                class="category {{ !request('category') ? 'active' : '' }}"
            >
                Todas
            </a>

            @foreach($categories as $category)

                <a
                    href="{{ route('recipes.index', [
                        'q' => request('q'),
                        'category' => $category->slug
                    ]) }}"
                    class="category {{
                        request('category') === $category->slug
                        ? 'active'
                        : ''
                    }}"
                >
                    {{ $category->name }}
                </a>

            @endforeach

        </div>

        <section class="recipes-results">

            <div class="results-heading">
                <h2>Receitas disponíveis</h2>

                <span>
                    {{ $recipes->count() }}
                    {{ $recipes->count() === 1 ? 'receita' : 'receitas' }}
                </span>
            </div>

            <div class="recipes-grid">

                @forelse($recipes as $recipe)

                    <a
                        href="{{ route('recipes.show', $recipe->slug) }}"
                        class="recipe-card"
                    >

                        <div class="recipe-image">

                            @if($recipe->image)

                                <img
                                    src="{{ asset('storage/' . $recipe->image) }}"
                                    alt="{{ $recipe->title }}"
                                >

                            @else

                                <span>SuChef</span>

                            @endif

                        </div>

                        <div class="recipe-info">

                            <span class="recipe-category">
                                {{ $recipe->category->name ?? 'Sem categoria' }}
                            </span>

                            <h2>{{ $recipe->title }}</h2>

                            <p>
                                {{ $recipe->description ?? 'Uma receita para experimentar.' }}
                            </p>

                            <div class="recipe-meta">

                                <span>
                                    {{ ($recipe->preparation_time ?? 0) + ($recipe->cooking_time ?? 0) }}
                                    min
                                </span>

                                <span>
                                    @switch($recipe->difficulty)
                                        @case('easy')
                                            Fácil
                                            @break

                                        @case('medium')
                                            Médio
                                            @break

                                        @case('hard')
                                            Difícil
                                            @break

                                        @default
                                            Não informado
                                    @endswitch
                                </span>

                            </div>

                            <div class="recipe-author">
                                Por {{ $recipe->user->name ?? 'Usuário SuChef' }}
                            </div>

                        </div>

                    </a>

                @empty

                    <div class="empty-recipes">
                        <span>✳</span>
                        <h3>Nenhuma receita encontrada</h3>
                        <p>
                            Tente outra busca ou selecione uma categoria diferente.
                        </p>

                        <a href="{{ route('recipes.index') }}">
                            Limpar filtros
                        </a>
                    </div>

                @endforelse

            </div>

        </section>

    </main>

</div>

@endsection
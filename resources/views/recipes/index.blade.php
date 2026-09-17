@extends('layouts.app')

@section('title', 'Explorar receitas — SuChef')

@section('content')

<div class="recipes-page">

    <nav class="navbar">

        <a href="{{ route('home') }}" class="logo">
            Su<span>Chef</span>
        </a>

        <ul class="nav-links">

            <li>
                <a href="{{ route('recipes.index') }}">
                    Explorar
                </a>
            </li>

            <li>
                <a href="#">
                    Comunidade
                </a>
            </li>

            <li>
                <a href="#">
                    Desafios
                </a>
            </li>

            <li>
                <a href="#" class="nav-login">
                    Entrar
                </a>
            </li>

        </ul>

    </nav>


    <main class="recipes-content">

        <div class="recipes-header">

            <span class="recipes-label">
                DESCUBRA
            </span>

            <h1>
                Explorar receitas<span>.</span>
            </h1>

            <p>
                Encontre algo novo para preparar,
                compartilhe suas criações e descubra
                receitas da comunidade.
            </p>

        </div>


        <div class="recipe-search">

            <input
                type="text"
                placeholder="Buscar receitas..."
            >

            <button type="button">
                Buscar
            </button>

        </div>


        <div class="categories">

            <button class="category active">
                Todas
            </button>

            <button class="category">
                Massas
            </button>

            <button class="category">
                Carnes
            </button>

            <button class="category">
                Doces
            </button>

            <button class="category">
                Bebidas
            </button>

        </div>


        <section class="recipes-grid">

            <article class="recipe-card">

                <div class="recipe-image">
                    Imagem
                </div>

                <div class="recipe-info">

                    <span class="recipe-category">
                        Massas
                    </span>

                    <h2>
                        Macarrão especial
                    </h2>

                    <p>
                        Uma receita simples e saborosa.
                    </p>

                    <div class="recipe-meta">
                        <span>30 min</span>
                        <span>Fácil</span>
                    </div>

                </div>

            </article>


            <article class="recipe-card">

                <div class="recipe-image">
                    Imagem
                </div>

                <div class="recipe-info">

                    <span class="recipe-category">
                        Doces
                    </span>

                    <h2>
                        Bolo de chocolate
                    </h2>

                    <p>
                        Clássico, simples e perfeito.
                    </p>

                    <div class="recipe-meta">
                        <span>45 min</span>
                        <span>Médio</span>
                    </div>

                </div>

            </article>


            <article class="recipe-card">

                <div class="recipe-image">
                    Imagem
                </div>

                <div class="recipe-info">

                    <span class="recipe-category">
                        Carnes
                    </span>

                    <h2>
                        Hambúrguer artesanal
                    </h2>

                    <p>
                        Uma opção para preparar em casa.
                    </p>

                    <div class="recipe-meta">
                        <span>25 min</span>
                        <span>Médio</span>
                    </div>

                </div>

            </article>

        </section>

    </main>

</div>

@endsection
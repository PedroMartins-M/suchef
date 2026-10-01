@extends('layouts.app')

@section('title', 'Macarrão especial — SuChef')

@section('content')

<div class="recipe-show-page">

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

    <main class="recipe-show-content">

        <a href="{{ route('recipes.index') }}" class="back-link">
            ← Voltar para receitas
        </a>

        <div class="recipe-show-grid">

            <div class="recipe-show-image">
                Imagem da receita
            </div>

            <div class="recipe-show-info">

                <span class="recipe-category">
                    Massas
                </span>

                <h1>
                    Macarrão especial
                </h1>

                <p class="recipe-description">
                    Uma receita simples, saborosa e perfeita
                    para preparar em casa.
                </p>

                <div class="recipe-details">

                    <div>
                        <strong>30 min</strong>
                        <span>Preparo</span>
                    </div>

                    <div>
                        <strong>2</strong>
                        <span>Porções</span>
                    </div>

                    <div>
                        <strong>Fácil</strong>
                        <span>Dificuldade</span>
                    </div>

                </div>

                <button class="start-recipe">
                    Começar receita
                </button>

            </div>

        </div>

        <section class="recipe-section">

            <h2>Ingredientes</h2>

            <ul class="ingredients-list">
                <li>200g de macarrão</li>
                <li>2 tomates</li>
                <li>1 dente de alho</li>
                <li>1 colher de azeite</li>
                <li>Sal a gosto</li>
            </ul>

        </section>

        <section class="recipe-section">

            <h2>Modo de preparo</h2>

            <ol class="steps-list">
                <li>
                    Cozinhe o macarrão até ficar no ponto desejado.
                </li>

                <li>
                    Refogue o alho e os tomates no azeite.
                </li>

                <li>
                    Misture o molho ao macarrão.
                </li>

                <li>
                    Ajuste o sal e sirva.
                </li>
            </ol>

        </section>

    </main>

</div>

@endsection
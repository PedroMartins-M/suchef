@extends('layouts.app')

@section('title', 'SuChef — Cozinhe do seu jeito')

@section('content')

<div class="home">

    <nav class="navbar">

        <a href="{{ route('home') }}" class="logo">
            Su<span>Chef</span>
        </a>

        <ul class="nav-links">

            <li>
                <a href="#">Explorar</a>
            </li>

            <li>
                <a href="#">Comunidade</a>
            </li>

            <li>
                <a href="#">Desafios</a>
            </li>

            <li>
                <a href="#" class="nav-login">
                    Entrar
                </a>
            </li>

        </ul>

    </nav>


    <main class="hero">

        <div class="hero-content">

            <span class="hero-label">
                Sua cozinha. Seu espaço.
            </span>

            <h1>
                Cozinhe.
                <span>Compartilhe.</span>
                Experimente.
            </h1>

            <p class="hero-description">
                Descubra receitas, compartilhe suas criações,
                desafie seus amigos e tenha um SuChef ao seu lado
                quando precisar.
            </p>

            <div class="hero-actions">

                <a href="#" class="btn-primary">
                    Começar agora
                </a>

                <a href="#" class="btn-secondary">
                    Explorar receitas
                </a>

            </div>

        </div>

    </main>

</div>

@endsection
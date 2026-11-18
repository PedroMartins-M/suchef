
@extends('layouts.app')

@section('title', $pageTitle . ' — SuChef')

@section('content')
<div class="app-layout">
    @include('components.sidebar')

    <main class="app-main">
        <header class="topbar">
            <span>SuChef / {{ $pageTitle }}</span>
            <a href="{{ route('recipes.create') }}" class="topbar-button">
                + Nova receita
            </a>
        </header>

        <section class="page-heading">
            <span class="eyebrow">{{ $eyebrow }}</span>
            <h1>{{ $pageTitle }}<span>.</span></h1>
            <p>{{ $description }}</p>
        </section>

        @if($section === 'community')
            <div class="feature-card">
                <span class="feature-icon">♧</span>
                <h2>Uma cozinha cheia de ideias.</h2>
                <p>Em breve você poderá acompanhar receitas, conhecer outros cozinheiros e compartilhar suas criações.</p>
                <a href="{{ route('recipes.index') }}" class="primary-button">Explorar receitas</a>
            </div>
        @elseif($section === 'challenges')
            <div class="feature-card">
                <span class="feature-icon">⚑</span>
                <h2>Aceite um novo desafio.</h2>
                <p>Prepare receitas temáticas, desafie seus amigos e mostre suas habilidades na cozinha.</p>
                <span class="coming-soon">DESAFIOS EM PREPARAÇÃO</span>
            </div>
        @elseif($section === 'assistant')
            <div class="assistant-card">
                <div class="assistant-icon">✳</div>
                <h2>Olá! Eu sou seu SuChef.</h2>
                <p>Posso ajudar você a pensar em pratos, aproveitar ingredientes e encontrar substituições.</p>

                <div class="assistant-suggestions">
                    <span>O que posso cozinhar hoje?</span>
                    <span>Como substituir um ingrediente?</span>
                    <span>Quero uma receita fácil.</span>
                </div>

                <form class="assistant-form" onsubmit="return false;">
                    <input type="text" placeholder="Converse com seu SuChef..." disabled>
                    <button type="button" disabled>Enviar</button>
                </form>
                <small>A integração com inteligência artificial será adicionada posteriormente.</small>
            </div>
        @elseif($section === 'profile')
            <div class="profile-card">
                <div class="profile-avatar">S</div>
                <h2>Seu perfil gastronômico</h2>
                <p>Seu espaço para apresentar suas receitas e sua trajetória na comunidade SuChef.</p>
                <div class="profile-stats">
                    <div><strong>0</strong><span>Receitas</span></div>
                    <div><strong>1</strong><span>Nível inicial</span></div>
                    <div><strong>0</strong><span>XP</span></div>
                </div>
                <a href="{{ route('recipes.create') }}" class="primary-button">Criar minha primeira receita</a>
            </div>
        @endif
    </main>
</div>
@endsection
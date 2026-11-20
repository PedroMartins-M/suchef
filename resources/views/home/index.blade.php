@extends('layouts.app')

@section('title', 'SuChef — Sua cozinha, seu espaço')

@section('content')
<div class="app-layout">

    @include('components.sidebar')

    <main class="app-main">

        <header class="topbar">
            <span>SuChef / Início</span>
            <a href="{{ route('recipes.create') }}" class="topbar-button">
                ''Nova receita
            </a>
        </header>

        <section class="page-heading">
            <span class="eyebrow">SUA COZINHA. SEU ESPAÇO.</span>
            <h1>Bem-vindo ao SuChef<span>.</span></h1>
            <p>
                Descubra receitas, compartilhe suas criações e explore
                novas possibilidades na cozinha.
            </p>
        </section>

        <section class="home-feature">
            <div>
                <span class="eyebrow">EXPLORE NOVOS SABORES</span>
                <h2>O próximo prato incrível pode começar aqui.</h2>
                <p>
                    Encontre inspirações, experimente combinações
                    e compartilhe suas receitas.
                </p>
                <a href="{{ route('recipes.index') }}" class="btn-primary">
                    Explorar receitas
                </a>
            </div>
        </section>

        <section class="home-shortcuts">
            <h2>O que deseja fazer?</h2>

            <div class="shortcut-grid">

                <a href="{{ route('recipes.index') }}" class="shortcut-card">
                    <h3>Explorar receitas</h3>
                    <p>Descubra pratos e novas ideias.</p>
                </a>

                <a href="{{ route('recipes.create') }}" class="shortcut-card">
                    <h3>Criar receita</h3>
                    <p>Compartilhe suas criações culinárias.</p>
                </a>

                <a href="{{ route('community') }}" class="shortcut-card">
                    <h3>Comunidade</h3>
                    <p>Conheça outros apaixonados por cozinha.</p>
                </a>

                <a href="{{ route('challenges') }}" class="shortcut-card">
                    <h3>Desafios</h3>
                    <p>Saia da rotina e teste suas habilidades.</p>
                </a>

                <a href="{{ route('assistant') }}" class="shortcut-card">
                    <h3>Assistente SuChef</h3>
                    <p>Encontre ajuda e ideias para cozinhar.</p>
                </a>

                <a href="{{ route('profile') }}" class="shortcut-card">
                    <h3>Meu perfil</h3>
                    <p>Acompanhe seu espaço e suas criações.</p>
                </a>

            </div>
        </section>

    </main>
</div>
@endsection
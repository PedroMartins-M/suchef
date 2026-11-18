
@extends('layouts.app')

@section('title', 'Entrar — SuChef')

@section('content')
<div class="auth-page">
    <div class="auth-card">
        <a href="{{ route('home') }}" class="logo">
            Su<span>Chef</span>.
        </a>

        <span class="eyebrow">SUA COZINHA TE ESPERA</span>
        <h1>Que bom ter você de volta<span>.</span></h1>
        <p>Entre para continuar sua jornada culinária.</p>

        <form method="POST" action="{{ route('login.store') }}">
            @csrf

            <label>E-mail</label>
            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
            >

            @error('email')
                <small>{{ $message }}</small>
            @enderror

            <label>Senha</label>
            <input type="password" name="password" required>

            <button type="submit" class="btn-primary">
                Entrar
            </button>
        </form>

        <p class="auth-footer">
            Ainda não tem uma conta?
            <a href="{{ route('register') }}">Cadastre-se</a>
        </p>
    </div>
</div>
@endsection
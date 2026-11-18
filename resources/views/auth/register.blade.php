
@extends('layouts.app')

@section('title', 'Criar conta — SuChef')

@section('content')
<div class="auth-page">
    <div class="auth-card">
        <a href="{{ route('home') }}" class="logo">
            Su<span>Chef</span>.
        </a>

        <span class="eyebrow">BEM-VINDO À COMUNIDADE</span>
        <h1>Crie sua conta<span>.</span></h1>
        <p>Comece a compartilhar suas experiências na cozinha.</p>

        <form method="POST" action="{{ route('register.store') }}">
            @csrf

            <label>Nome completo</label>
            <input name="name" value="{{ old('name') }}" required>
            @error('name') <small>{{ $message }}</small> @enderror

            <label>Nome de usuário</label>
            <input name="username" value="{{ old('username') }}" required>
            @error('username') <small>{{ $message }}</small> @enderror

            <label>E-mail</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
            @error('email') <small>{{ $message }}</small> @enderror

            <label>Senha</label>
            <input type="password" name="password" required>
            @error('password') <small>{{ $message }}</small> @enderror

            <label>Confirme sua senha</label>
            <input type="password" name="password_confirmation" required>

            <button type="submit" class="btn-primary">
                Criar minha conta
            </button>
        </form>

        <p class="auth-footer">
            Já tem uma conta?
            <a href="{{ route('login') }}">Entrar</a>
        </p>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('title', 'Configurações | SuChef')

@section('content')
<div class="app-layout">
    @include('components.sidebar')

    <main class="app-main">
        <div class="topbar">
            <div>
                <span class="page-eyebrow">PERSONALIZE SUA EXPERIÊNCIA</span>
                <h1>Configurações</h1>
            </div>
            <a href="{{ route('profile') }}" class="topbar-button">
                Voltar ao perfil
            </a>
        </div>

        @if(session('success'))
            <div class="settings-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="settings-errors">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('settings.update') }}"
              method="POST"
              enctype="multipart/form-data"
              class="settings-form">

            @csrf
            @method('PUT')

            <section class="settings-card">
                <div class="settings-heading">
                    <div>
                        <h2>Foto de perfil</h2>
                        <p>Escolha uma imagem para representar sua cozinha.</p>
                    </div>
                </div>

                <div class="settings-avatar-area">
                    <div class="settings-avatar" id="avatarPreview">
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="Foto atual">
                        @else
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        @endif
                    </div>

                    <div class="settings-avatar-actions">
                        <label for="avatarInput" class="settings-upload-button">
                            Escolher imagem
                        </label>
                        <input type="file"
                               name="avatar"
                               id="avatarInput"
                               accept="image/jpeg,image/png,image/webp"
                               hidden>
                        <small>JPG, PNG ou WEBP. Máximo de 2 MB.</small>
                    </div>
                </div>
            </section>

            <section class="settings-card">
                <div class="settings-heading">
                    <div>
                        <p>Atualize as informações da sua conta.</p>
                    </div>
                </div>

                <div class="settings-grid">
                    <div class="settings-field">
                        <label for="name">Nome completo</label>
                        <input type="text" id="name" name="name"
                               value="{{ old('name', $user->name) }}" required>
                    </div>

                    <div class="settings-field">
                        <label for="username">Nome de usuário</label>
                        <input type="text" id="username" name="username"
                               value="{{ old('username', $user->username) }}" required>
                    </div>

                    <div class="settings-field full">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email"
                               value="{{ old('email', $user->email) }}" required>
                    </div>

                    <div class="settings-field full">
                        <label for="bio">Biografia</label>
                        <textarea id="bio" name="bio" rows="4"
                                  maxlength="500"
                                  placeholder="Conte um pouco sobre sua relação com a cozinha...">{{ old('bio', $user->bio) }}</textarea>
                        <small>Máximo de 500 caracteres.</small>
                    </div>
                </div>
            </section>

            <section class="settings-card">
                <div class="settings-heading">
                    <div>
                        <h2>Preferências</h2>
                        <p>Escolha quais atualizações deseja receber.</p>
                    </div>
                </div>

                <label class="settings-option">
                    <div>
                        <strong>Notificações</strong>
                        <small>Receber avisos e novidades do SuChef.</small>
                    </div>
                    <input type="checkbox" name="notifications" value="1"
                           @checked($preferences['notifications'])>
                </label>

                <label class="settings-option">
                    <div>
                        <strong>Atualizações de receitas</strong>
                        <small>Receber novidades relacionadas às receitas.</small>
                    </div>
                    <input type="checkbox" name="recipe_updates" value="1"
                           @checked($preferences['recipe_updates'])>
                </label>
            </section>

            <div class="settings-footer">
                <button type="submit" class="settings-save-button">
                    Salvar alterações
                </button>
            </div>
        </form>
    </main>
</div>

<script>
document.getElementById('avatarInput').addEventListener('change', function(event) {
    const file = event.target.files[0];

    if (!file) return;

    const preview = document.getElementById('avatarPreview');

    if (preview.querySelector('img')) {
        preview.querySelector('img').src = URL.createObjectURL(file);
    } else {
        preview.innerHTML = '';

        const image = document.createElement('img');
        image.src = URL.createObjectURL(file);
        image.alt = 'Pré-visualização da foto';

        preview.appendChild(image);
    }
});
</script>
@endsection

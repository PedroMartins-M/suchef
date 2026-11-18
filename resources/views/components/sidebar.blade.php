<aside class="sidebar">
    <a href="{{ route('home') }}" class="logo">
        Su<span>Chef</span><small>.</small>
    </a>

    <span class="sidebar-label">MENU PRINCIPAL</span>

    <nav class="sidebar-nav">
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
            <span>⌂</span> Início
        </a>

        <a href="{{ route('recipes.index') }}" class="{{ request()->routeIs('recipes.*') ? 'active' : '' }}">
            <span>▤</span> Explorar receitas
        </a>

        @auth
            <a href="{{ route('recipes.create') }}">
                <span>＋</span> Criar receita
            </a>
        @endauth

        <a href="{{ route('community') }}" class="{{ request()->routeIs('community') ? 'active' : '' }}">
            <span>♧</span> Comunidade
        </a>

        <a href="{{ route('challenges') }}" class="{{ request()->routeIs('challenges') ? 'active' : '' }}">
            <span>⚑</span> Desafios
        </a>
    </nav>

    <span class="sidebar-label">SEU ESPAÇO</span>

    <nav class="sidebar-nav">
        <a href="{{ route('assistant') }}" class="{{ request()->routeIs('assistant') ? 'active' : '' }}">
            <span>✧</span> Assistente SuChef
        </a>

        @auth
            <a href="{{ route('profile') }}" class="{{ request()->routeIs('profile') ? 'active' : '' }}">
                <span>◎</span> Meu perfil
            </a>

            <a href="{{ route('settings.edit') }}" class="{{ request()->routeIs('settings.*') ? 'active' : '' }}">
                <span>⚙</span> Configurações
            </a>
        @endauth
    </nav>

    <div class="sidebar-bottom">
        @auth
            <div class="sidebar-avatar">
                @if(Auth::user()->avatar)
                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar">
                @else
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                @endif
            </div>

            <div>
                <strong>{{ Auth::user()->name }}</strong>
                <small>{{ '@' . Auth::user()->username }}</small>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="sidebar-logout" title="Sair da conta">
                    Sair
                </button>
            </form>
        @else
            <div>
                <a href="{{ route('login') }}">Entrar na conta</a>
            </div>
        @endauth
    </div>
</aside>

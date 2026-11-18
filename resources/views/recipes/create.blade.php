@extends('layouts.app')

@section('title', 'Criar receita | SuChef')

@section('content')

    <div class="app-layout">

    @include('components.sidebar')
    <main class="app-main">
        <div class="topbar">
            <div>
                <span class="page-eyebrow">SUA COZINHA, SUAS CRIAÇÕES</span>
                <h2>Nova receita</h2>
            </div>

            <a href="{{ route('recipes.index') }}" class="btn-secondary">
                Voltar às receitas
            </a>
        </div>

        <div class="create-recipe-container">
            <div class="create-recipe-heading">
                <span class="page-eyebrow">COMPARTILHE SEU SABOR</span>
                <h1>Vamos criar algo delicioso?</h1>
                <p>Preencha os detalhes e compartilhe sua receita com a comunidade.</p>
            </div>

            @if ($errors->any && $errors->any())
                <div class="form-errors">
                    <strong>Não foi possível publicar sua receita:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data" id="recipeForm">
                @csrf

                <section class="recipe-form-section">
                    <div class="form-section-heading">
                        <span>01</span>
                        <div>
                            <h2>Informações principais</h2>
                            <p>Comece apresentando sua receita.</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title">Nome da receita *</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}"
                            placeholder="Ex.: Macarrão cremoso especial" maxlength="150" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Descrição</label>
                        <textarea id="description" name="description" rows="3" placeholder="Conte um pouco sobre essa receita...">{{ old('description') }}</textarea>
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label for="category_id">Categoria</label>
                            <select name="category_id" id="category_id">
                                <option value="">Selecione uma categoria</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="difficulty">Dificuldade *</label>
                            <select name="difficulty" id="difficulty" required>
                                <option value="easy" @selected(old('difficulty') == 'easy')>Fácil</option>
                                <option value="medium" @selected(old('difficulty', 'medium') == 'medium')>Médio</option>
                                <option value="hard" @selected(old('difficulty') == 'hard')>Difícil</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="image">Imagem da receita</label>
                        <input type="file" id="image" name="image" accept="image/*">
                        <small>Imagem opcional. Tamanho máximo: 2 MB.</small>
                    </div>
                </section>

                <section class="recipe-form-section">
                    <div class="form-section-heading">
                        <span>02</span>
                        <div>
                            <h2>Detalhes do preparo</h2>
                            <p>Informe o tempo e o rendimento.</p>
                        </div>
                    </div>

                    <div class="form-grid form-grid-three">
                        <div class="form-group">
                            <label for="preparation_time">Preparo (min)</label>
                            <input type="number" id="preparation_time" name="preparation_time"
                                value="{{ old('preparation_time') }}" min="0" placeholder="15">
                        </div>

                        <div class="form-group">
                            <label for="cooking_time">Cozimento (min)</label>
                            <input type="number" id="cooking_time" name="cooking_time" value="{{ old('cooking_time') }}"
                                min="0" placeholder="30">
                        </div>

                        <div class="form-group">
                            <label for="servings">Porções *</label>
                            <input type="number" id="servings" name="servings" value="{{ old('servings', 2) }}"
                                min="1" required>
                        </div>
                    </div>
                </section>

                <section class="recipe-form-section">
                    <div class="form-section-heading">
                        <span>03</span>
                        <div>
                            <h2>Ingredientes</h2>
                            <p>Adicione tudo o que será necessário.</p>
                        </div>
                    </div>

                    <div id="ingredientsList">
                        <div class="dynamic-form-row ingredient-row">
                            <input type="text" name="ingredients[0][name]" placeholder="Nome do ingrediente" required>

                            <input type="number" name="ingredients[0][quantity]" placeholder="Qtd." min="0"
                                step="0.01">

                            <input type="text" name="ingredients[0][unit]" placeholder="Unidade">

                            <button type="button" class="remove-row" aria-label="Remover ingrediente" disabled>
                                ×
                            </button>
                        </div>
                    </div>

                    <button type="button" class="add-row-button" id="addIngredient">
                        + Adicionar ingrediente
                    </button>
                </section>

                <section class="recipe-form-section">
                    <div class="form-section-heading">
                        <span>04</span>
                        <div>
                            <h2>Modo de preparo</h2>
                            <p>Explique o passo a passo da receita.</p>
                        </div>
                    </div>

                    <div id="stepsList">
                        <div class="dynamic-form-row step-row">
                            <span class="step-number">1</span>
                            <textarea name="steps[0][instruction]" rows="2" placeholder="Descreva a primeira etapa..." required></textarea>

                            <button type="button" class="remove-row" aria-label="Remover etapa" disabled>
                                ×
                            </button>
                        </div>
                    </div>

                    <button type="button" class="add-row-button" id="addStep">
                        + Adicionar etapa
                    </button>
                </section>

                <div class="recipe-form-footer">
                    <a href="{{ route('recipes.index') }}" class="btn-secondary">
                        Cancelar
                    </a>

                    <button type="submit" class="btn-primary">
                        Publicar receita
                    </button>
                </div>
            </form>
        </div>
    </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ingredientsList = document.getElementById('ingredientsList');
            const stepsList = document.getElementById('stepsList');

            const addIngredient = document.getElementById('addIngredient');
            const addStep = document.getElementById('addStep');

            let ingredientCount = 1;
            let stepCount = 1;

            function updateRemoveButtons(container, selector) {
                const rows = container.querySelectorAll(selector);

                rows.forEach(row => {
                    const button = row.querySelector('.remove-row');
                    button.disabled = rows.length === 1;
                });
            }

            addIngredient.addEventListener('click', function() {
                const row = document.createElement('div');
                row.className = 'dynamic-form-row ingredient-row';

                row.innerHTML = `
                <input type="text"
                    name="ingredients[${ingredientCount}][name]"
                    placeholder="Nome do ingrediente" required>

                <input type="number"
                    name="ingredients[${ingredientCount}][quantity]"
                    placeholder="Qtd." min="0" step="0.01">

                <input type="text"
                    name="ingredients[${ingredientCount}][unit]"
                    placeholder="Unidade">

                <button type="button" class="remove-row"
                        aria-label="Remover ingrediente">×</button>
            `;

                ingredientsList.appendChild(row);
                ingredientCount++;
                updateRemoveButtons(ingredientsList, '.ingredient-row');
            });

            addStep.addEventListener('click', function() {
                const row = document.createElement('div');
                row.className = 'dynamic-form-row step-row';

                row.innerHTML = `
                <span class="step-number">${stepCount + 1}</span>

                <textarea name="steps[${stepCount}][instruction]"
                        rows="2"
                        placeholder="Descreva esta etapa..."
                        required></textarea>

                <button type="button" class="remove-row"
                        aria-label="Remover etapa">×</button>
            `;

                stepsList.appendChild(row);
                stepCount++;
                updateRemoveButtons(stepsList, '.step-row');
                updateStepNumbers();
            });

            function updateStepNumbers() {
                stepsList.querySelectorAll('.step-row').forEach((row, index) => {
                    row.querySelector('.step-number').textContent = index + 1;
                });
            }

            document.addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-row')) {
                    const row = event.target.closest('.dynamic-form-row');
                    const container = row.parentElement;

                    row.remove();

                    updateRemoveButtons(
                        container,
                        container === ingredientsList ? '.ingredient-row' : '.step-row'
                    );

                    if (container === stepsList) {
                        updateStepNumbers();
                    }
                }
            });
        });
    </script>
@endsection

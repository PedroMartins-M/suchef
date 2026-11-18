<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\RecipeStep;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SuChefSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'chef@suchef.test'],
            ['name' => 'Chef SuChef', 'password' => 'password']
        );

        $categorias = [
            'Massas' => 'Espaguetes, lasanhas e outras massas.',
            'Sobremesas' => 'Doces para fechar a refeição.',
            'Carnes' => 'Pratos com carne bovina, suína e aves.',
            'Saladas' => 'Opções leves e frescas.',
            'Bebidas' => 'Sucos, drinks e bebidas em geral.',
            'Pratos vegetarianos' => 'Receitas sem carne.',
        ];

        $cats = [];
        foreach ($categorias as $nome => $descricao) {
            $cats[$nome] = Category::updateOrCreate(
                ['slug' => Str::slug($nome)],
                ['name' => $nome, 'description' => $descricao]
            );
        }

        $nomes = [
            'Espaguete', 'Ovo', 'Bacon', 'Queijo parmesão', 'Pimenta-do-reino',
            'Tomate', 'Alface', 'Azeite', 'Sal', 'Chocolate meio amargo',
            'Manteiga', 'Açúcar', 'Farinha de trigo',
        ];

        $ing = [];
        foreach ($nomes as $nome) {
            $ing[$nome] = Ingredient::updateOrCreate(
                ['slug' => Str::slug($nome)],
                ['name' => $nome]
            );
        }

        $receitas = [
            [
                'title' => 'Espaguete à carbonara',
                'category' => 'Massas',
                'description' => 'Clássico cremoso feito com ovos, bacon e parmesão.',
                'preparation_time' => 10,
                'cooking_time' => 20,
                'servings' => 4,
                'difficulty' => 'medium',
                'ingredients' => [
                    'Espaguete' => [400, 'g'],
                    'Ovo' => [4, 'un'],
                    'Bacon' => [150, 'g'],
                    'Queijo parmesão' => [80, 'g'],
                    'Pimenta-do-reino' => [1, 'colher de chá'],
                ],
                'steps' => [
                    'Cozinhe o espaguete em água fervente com sal até ficar al dente.',
                    'Frite o bacon em cubos até dourar.',
                    'Misture os ovos com o parmesão e a pimenta.',
                    'Junte a massa quente ao bacon, desligue o fogo e misture o creme de ovos.',
                ],
            ],
            [
                'title' => 'Salada de tomate e alface',
                'category' => 'Saladas',
                'description' => 'Salada rápida, leve e fresca.',
                'preparation_time' => 10,
                'cooking_time' => 0,
                'servings' => 2,
                'difficulty' => 'easy',
                'ingredients' => [
                    'Tomate' => [3, 'un'],
                    'Alface' => [1, 'pé'],
                    'Azeite' => [3, 'colher de sopa'],
                    'Sal' => [1, 'pitada'],
                ],
                'steps' => [
                    'Lave e seque bem a alface e rasgue em pedaços.',
                    'Corte o tomate em fatias.',
                    'Tempere com azeite e sal e sirva.',
                ],
            ],
            [
                'title' => 'Brownie de chocolate',
                'category' => 'Sobremesas',
                'description' => 'Brownie úmido por dentro e crocante por fora.',
                'preparation_time' => 15,
                'cooking_time' => 30,
                'servings' => 8,
                'difficulty' => 'easy',
                'ingredients' => [
                    'Chocolate meio amargo' => [200, 'g'],
                    'Manteiga' => [150, 'g'],
                    'Açúcar' => [150, 'g'],
                    'Ovo' => [3, 'un'],
                    'Farinha de trigo' => [80, 'g'],
                ],
                'steps' => [
                    'Derreta o chocolate com a manteiga.',
                    'Misture o açúcar e os ovos.',
                    'Acrescente a farinha e mexa até incorporar.',
                    'Asse a 180 °C por cerca de 30 minutos.',
                ],
            ],
        ];

        foreach ($receitas as $r) {
            $recipe = Recipe::updateOrCreate(
                ['slug' => Str::slug($r['title'])],
                [
                    'user_id' => $user->id,
                    'category_id' => $cats[$r['category']]->id,
                    'title' => $r['title'],
                    'description' => $r['description'],
                    'preparation_time' => $r['preparation_time'],
                    'cooking_time' => $r['cooking_time'],
                    'servings' => $r['servings'],
                    'difficulty' => $r['difficulty'],
                    'status' => 'published',
                    'visibility' => 'public',
                ]
            );

            $pivot = [];
            foreach ($r['ingredients'] as $nome => [$qtd, $un]) {
                $pivot[$ing[$nome]->id] = ['quantity' => $qtd, 'unit' => $un];
            }
            $recipe->ingredients()->sync($pivot);

            foreach ($r['steps'] as $i => $texto) {
                RecipeStep::updateOrCreate(
                    ['recipe_id' => $recipe->id, 'step_number' => $i + 1],
                    ['instruction' => $texto]
                );
            }
        }
    }
}
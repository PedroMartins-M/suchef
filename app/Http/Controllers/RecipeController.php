<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Category;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('name')->get();

        $query = Recipe::with(['category', 'user'])
            ->where('status', 'published')
            ->where('visibility', 'public');

        if ($request->filled('q')) {
            $search = $request->q;

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $recipes = $query->latest()->get();

        return view('recipes.index', compact('recipes', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('recipes.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'preparation_time' => ['nullable', 'integer', 'min:0'],
            'cooking_time' => ['nullable', 'integer', 'min:0'],
            'servings' => ['required', 'integer', 'min:1'],
            'difficulty' => ['required', 'in:easy,medium,hard'],
            'image' => ['nullable', 'image', 'max:2048'],

            'ingredients' => ['required', 'array', 'min:1'],
            'ingredients.*.name' => ['required', 'string', 'max:100'],
            'ingredients.*.quantity' => ['nullable', 'numeric', 'min:0'],
            'ingredients.*.unit' => ['nullable', 'string', 'max:50'],

            'steps' => ['required', 'array', 'min:1'],
            'steps.*.instruction' => ['required', 'string'],
        ]);

        $recipe = DB::transaction(function () use ($request, $data) {

            $baseSlug = Str::slug($data['title']);
            $slug = $baseSlug . '-' . Str::lower(Str::random(6));

            $imagePath = null;

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')
                    ->store('recipes', 'public');
            }

            $recipe = Recipe::create([
                'user_id' => Auth::id(),
                'category_id' => $data['category_id'] ?? null,
                'title' => $data['title'],
                'slug' => $slug,
                'description' => $data['description'] ?? null,
                'image' => $imagePath,
                'preparation_time' => $data['preparation_time'] ?? null,
                'cooking_time' => $data['cooking_time'] ?? null,
                'servings' => $data['servings'],
                'difficulty' => $data['difficulty'],
                'status' => 'published',
                'visibility' => 'public',
            ]);

            foreach ($data['ingredients'] as $item) {
                $name = trim($item['name']);

                $ingredient = Ingredient::firstOrCreate(
                    ['name' => $name],
                    ['slug' => Str::slug($name)]
                );

                $recipe->ingredients()->attach($ingredient->id, [
                    'quantity' => $item['quantity'] ?? null,
                    'unit' => $item['unit'] ?? null,
                ]);
            }

            foreach ($data['steps'] as $index => $step) {
                $recipe->steps()->create([
                    'step_number' => $index + 1,
                    'instruction' => $step['instruction'],
                ]);
            }

            return $recipe;
        });

        return redirect()
            ->route('recipes.show', $recipe->slug)
            ->with('success', 'Receita publicada com sucesso!');
    }

    public function show($slug)
    {
        $recipe = Recipe::with([
            'user',
            'category',
            'ingredients',
            'steps'
        ])
        ->where('slug', $slug)
        ->firstOrFail();

        return view('recipes.show', compact('recipe'));
    }
}

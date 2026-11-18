<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Recipe;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->get();

        $recipes = Recipe::with(['user', 'category'])
            ->where('status', 'published')
            ->where('visibility', 'public')
            ->latest()
            ->take(4)
            ->get();

        return view('home.index', compact(
            'categories',
            'recipes'
        ));
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecipeController
{
    public function index()
    {
        return view('recipes.index');
    }

    public function show($slug) {
        return view('recipes.show');
    }
}

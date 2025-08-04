<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AIService;

class RecipeController extends Controller
{
    public function showForm()
    {
        return view('recipe_form');
    }

    public function generate(Request $request, AIService $aiService)
    {
        $request->validate([
            'ingredients' => 'required|string|min:3'
        ]);

        try {
            $recipe = $aiService->generateRecipe($request->input('ingredients'));
            return view('recipe_form', ['recipe' => $recipe]);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'AI request failed: ' . $e->getMessage()]);
        }
    }
}
@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg" style="border-radius: 20px;">
        <div class="card-body" style="background-color: #fff5f7;">
            <h1 class="text-center mb-4" style="color: #ff6f91;">AI Recipe Generator</h1>
            
            <p class="text-center mb-4" style="color: #6a0572;">
                Enter a list of ingredients, and this app will create a recipe using AI.
                <br>
                Example: <em>chicken, garlic, spinach</em>
                <br>
                The AI will suggest a title, ingredients, and step-by-step instructions.
            </p>

            <form method="POST" action="{{ route('recipe.generate') }}">
                @csrf
                <div class="mb-3">
                    <label for="ingredients" class="form-label" style="color: #6a0572;">Your Ingredients:</label>
                    <input type="text" name="ingredients" id="ingredients" class="form-control" style="border-color: #ff6f91;" placeholder="e.g., pasta, tomatoes, basil" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn" style="background-color: #ff6f91; color: white; border-radius: 25px; padding: 10px 20px;">
                        Generate Recipe
                    </button>
                </div>
            </form>

            @error('error')
                <div class="alert alert-danger mt-4">{{ $message }}</div>
            @enderror

            @isset($recipe)
                <div class="mt-5 p-4" style="background-color: #e0c3fc; border-radius: 15px;">
                    <h2 style="color: #6a0572;">Generated Recipe:</h2>
                    <pre class="mt-3" style="white-space: pre-wrap; color: #3b0a45;">{{ $recipe }}</pre>
                </div>
            @endisset
        </div>
    </div>
</div>
@endsection

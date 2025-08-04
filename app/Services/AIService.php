<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AIService
{
    public function generateRecipe(string $ingredients): string
    {
        $prompt = "You are a professional private chef. Create a simple, easy to execute, step-by-step recipe using the following ingredients: {$ingredients}. 
        Include a title, ingredients list, and cooking instructions.";

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.openai.key'),
            'Content-Type' => 'application/json',
        ])->post(config('services.openai.url') . '/chat/completions', [
            'model' => config('services.openai.model'),
            'messages' => [
                ['role' => 'user', 'content' => $prompt]
            ],
            'temperature' => 0.7,
            'max_tokens' => 500,
        ]);

        if (!$response->successful()) {
            throw new \Exception('API error: ' . $response->body());
        }

        return $response['choices'][0]['message']['content'] ?? 'No recipe generated.';
    }
}
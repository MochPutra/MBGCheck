<?php

namespace App\Http\Controllers;

use App\Models\Makanan;
use App\Models\Resep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GenerateResepController extends Controller
{
    public function generate(Request $request, $id)
    {
        if (!session('is_admin')) {
            return response()->json(['success' => false, 'error' => 'Unauthorized'], 403);
        }

        $makanan = Makanan::with('nilaiGizi')->findOrFail($id);
        $existingResep = Resep::where('id_makanan', $id)->first();

        $nama = $makanan->nama_makanan;
        $kategori = $makanan->kategori;
        $kalori = $makanan->nilaiGizi->kalori ?? 'tidak diketahui';
        $protein = $makanan->nilaiGizi->protein ?? 'tidak diketahui';
        $karbo = $makanan->nilaiGizi->karbohidrat ?? 'tidak diketahui';

        $prompt = "Buatkan resep lengkap untuk makanan \"{$nama}\" (kategori: {$kategori}).
Info gizi per porsi: Kalori {$kalori} Kkal, Protein {$protein}g, Karbohidrat {$karbo}g.

Format output (teks biasa, TANPA markdown):

BAHAN-BAHAN:
- [bahan beserta takarannya]

CARA MEMBUAT:
1. [langkah]

TIPS:
- [tips memasak]

Berikan resep dalam Bahasa Indonesia yang jelas. Jangan gunakan format markdown seperti ** atau #.";

        try {
            $generatedText = null;

            // Try Groq first (usually more reliable free tier)
            $groqKey = env('GROQ_API_KEY');
            if ($groqKey && !$generatedText) {
                $generatedText = $this->callGroq($groqKey, $prompt);
            }

            // Try Gemini as fallback
            $geminiKey = env('GEMINI_API_KEY');
            if ($geminiKey && !$generatedText) {
                $generatedText = $this->callGemini($geminiKey, $prompt);
            }

            if (!$generatedText) {
                return response()->json([
                    'success' => false,
                    'error' => 'Tidak bisa generate resep. Pastikan GROQ_API_KEY atau GEMINI_API_KEY sudah dikonfigurasi di .env dan kuotanya belum habis.'
                ]);
            }

            // Clean markdown
            $generatedText = preg_replace('/\*\*(.*?)\*\*/', '$1', $generatedText);
            $generatedText = preg_replace('/^#{1,3}\s*/m', '', $generatedText);
            $generatedText = trim($generatedText);

            // Save or update
            if ($existingResep) {
                $existingResep->update(['bahan_bahan' => $generatedText]);
            } else {
                Resep::create([
                    'id_makanan' => $id,
                    'bahan_bahan' => $generatedText,
                ]);
            }

            return response()->json([
                'success' => true,
                'resep' => $generatedText,
                'nama_makanan' => $nama,
            ]);

        } catch (\Exception $e) {
            Log::error("Generate resep error: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    private function callGroq($apiKey, $prompt)
    {
        try {
            $response = Http::withOptions(['verify' => false])
                ->timeout(60)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $apiKey,
                    'Content-Type' => 'application/json',
                ])
                ->post('https://api.groq.com/openai/v1/chat/completions', [
                    'model' => 'llama-3.3-70b-versatile',
                    'messages' => [
                        ['role' => 'user', 'content' => $prompt]
                    ],
                    'temperature' => 0.7,
                    'max_tokens' => 1024,
                ]);

            if ($response->successful()) {
                return $response->json('choices.0.message.content');
            }

            Log::warning("Groq API failed: HTTP {$response->status()} - " . substr($response->body(), 0, 200));
        } catch (\Exception $e) {
            Log::warning("Groq API exception: " . $e->getMessage());
        }

        return null;
    }

    private function callGemini($apiKey, $prompt)
    {
        $models = ['gemini-2.0-flash-lite', 'gemini-2.0-flash'];

        foreach ($models as $model) {
            try {
                $response = Http::withOptions(['verify' => false])
                    ->timeout(60)
                    ->post("https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}", [
                        'contents' => [
                            ['parts' => [['text' => $prompt]]]
                        ],
                        'generationConfig' => [
                            'temperature' => 0.7,
                            'maxOutputTokens' => 1024,
                        ]
                    ]);

                if ($response->successful()) {
                    return $response->json('candidates.0.content.parts.0.text');
                }

                Log::warning("Gemini {$model} failed: HTTP {$response->status()}");

                if ($response->status() !== 429) {
                    break; // Non-rate-limit error, stop trying
                }
            } catch (\Exception $e) {
                Log::warning("Gemini {$model} exception: " . $e->getMessage());
            }
        }

        return null;
    }
}

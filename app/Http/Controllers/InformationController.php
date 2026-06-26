<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\JsonResponse;

class InformationController extends Controller
{
    public function getArticles(): JsonResponse
    {
        $articles = Article::query()
            ->where('is_published', true)
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $articles,
        ]);
    }

    public function getArticle(int $id): JsonResponse
    {
        $article = Article::query()
            ->where('is_published', true)
            ->find($id);

        if (!$article) {
            return response()->json([
                'success' => false,
                'message' => 'Article not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $article,
        ]);
    }
}

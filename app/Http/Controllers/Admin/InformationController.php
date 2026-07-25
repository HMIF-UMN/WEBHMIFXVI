<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class InformationController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Information/Index', [
            'articles'   => Article::query()
                ->orderByDesc('published_at')
                ->orderByDesc('id')
                ->paginate(15)
                ->withQueryString(),
            'categories' => Article::CATEGORIES,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Information/Create', [
            'categories' => Article::CATEGORIES,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateArticle($request, imageRequired: true);

        $data['image_path']   = $request->file('image')->store('information', 'public');
        $data['is_published'] = $request->boolean('is_published');

        Article::create($data);

        return redirect()->route('admin.information.index')->with('success', 'Article published.');
    }

    public function edit(Article $article): Response
    {
        return Inertia::render('Admin/Information/Edit', [
            'article'    => $article,
            'categories' => Article::CATEGORIES,
        ]);
    }

    public function update(Request $request, Article $article): RedirectResponse
    {
        $data = $this->validateArticle($request, imageRequired: false);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($article->image_path);
            $data['image_path'] = $request->file('image')->store('information', 'public');
        }

        $data['is_published'] = $request->boolean('is_published');

        $article->update($data);

        return redirect()->route('admin.information.index')->with('success', 'Article updated.');
    }

    public function destroy(Article $article): RedirectResponse
    {
        Storage::disk('public')->delete($article->image_path);
        $article->delete();

        return redirect()->route('admin.information.index')->with('success', 'Article deleted.');
    }

    private function validateArticle(Request $request, bool $imageRequired): array
    {
        return $request->validate([
            'category'     => ['required', Rule::in(Article::CATEGORIES)],
            'title'        => ['required', 'string', 'max:255'],
            'published_at' => ['required', 'date'],
            'image'        => [$imageRequired ? 'required' : 'nullable', 'image', 'max:8192'],
            'image_alt'    => ['nullable', 'string', 'max:255'],
            'excerpt'      => ['required', 'string', 'max:500'],
            'content'      => ['required', 'string'],
            'is_published' => ['nullable', 'boolean'],
        ]);
    }
}

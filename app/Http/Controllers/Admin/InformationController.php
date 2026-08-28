<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Symfony\Component\DomCrawler\Crawler;
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

    public function fetchExternalNews(Request $request): RedirectResponse
    {
        $url = 'https://inf.umn.ac.id/berita';
        $response = Http::get($url);
        
        if (!$response->successful()) {
            return redirect()->route('admin.information.index')->with('error', 'Failed to fetch news from ' . $url);
        }

        $crawler = new Crawler($response->body(), $url);
        
        // Extract article links
        $links = $crawler->filter('a[href^="https://inf.umn.ac.id/berita/"]')->extract(['href']);
        $uniqueLinks = array_unique($links);
        
        $importedCount = 0;

        foreach ($uniqueLinks as $link) {
            $articleHtml = Http::get($link);
            if (!$articleHtml->successful()) continue;

            $articleCrawler = new Crawler($articleHtml->body(), $link);
            
            $titleNode = $articleCrawler->filter('h1.fw-bolder');
            if ($titleNode->count() === 0) continue;
            
            $title = trim($titleNode->text());

            $article = Article::where('title', $title)->first();

            // Extract excerpt and content to ensure we have the latest format
            $contentNode = $articleCrawler->filter('section.mb-5');
            if ($contentNode->count() === 0) continue;
            
            $rawHtml = $contentNode->html();
            $rawHtml = preg_replace('/<br\s*\/?>/i', "\n", $rawHtml);
            $rawHtml = preg_replace('/<\/(p|div)>/i', "\n\n", $rawHtml);
            
            $text = strip_tags($rawHtml);
            $text = str_replace("\r\n", "\n", $text);
            $formattedContent = preg_replace("/\n\s*\n+/", "\n\n", trim($text));
            $formattedContent = html_entity_decode($formattedContent, ENT_QUOTES | ENT_HTML5, 'UTF-8');

            $excerptNode = $contentNode->filter('p')->first();
            $excerpt = $excerptNode->count() > 0 ? Str::limit(strip_tags($excerptNode->text()), 490) : 'No excerpt';

            if ($article) {
                $article->update([
                    'excerpt' => $excerpt,
                    'content' => trim($formattedContent),
                ]);
                continue;
            }

            // Extract date
            $dateNode = $articleCrawler->filter('.text-muted.fst-italic');
            $dateStr = $dateNode->count() > 0 ? $dateNode->text() : now()->toDateString();
            $dateParts = explode(' by ', $dateStr);
            try {
                $publishedAt = Carbon::parse(trim($dateParts[0]))->toDateString();
            } catch (\Exception $e) {
                $publishedAt = now()->toDateString();
            }

            // Extract image
            $imageNode = $articleCrawler->filter('figure > img.img-fluid');
            $imageUrl = $imageNode->count() > 0 ? $imageNode->attr('src') : null;
            $imageAlt = $imageNode->count() > 0 ? $imageNode->attr('alt') : '';
            
            $imagePath = '';
            if ($imageUrl) {
                $imageContents = @file_get_contents($imageUrl);
                if ($imageContents) {
                    $imageName = 'information/' . uniqid() . '-' . basename(parse_url($imageUrl, PHP_URL_PATH));
                    Storage::disk('public')->put($imageName, $imageContents);
                    $imagePath = $imageName;
                }
            }

            Article::create([
                'category' => 'INFORMATION',
                'title' => $title,
                'published_at' => $publishedAt,
                'image_path' => $imagePath,
                'image_alt' => $imageAlt,
                'excerpt' => $excerpt,
                'content' => trim($formattedContent),
                'is_published' => true,
            ]);

            $importedCount++;
        }

        return redirect()->route('admin.information.index')->with('success', "Imported {$importedCount} articles from external site.");
    }
}

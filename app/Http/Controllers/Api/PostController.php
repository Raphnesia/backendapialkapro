<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

class PostController extends ApiController
{
    public function index(): JsonResponse
    {
        try {
            $posts = Post::published()
                ->latest()
                ->get()
                ->map(function ($post) {
                    return [
                        'id' => $post->id,
                        'title' => $post->title,
                        'slug' => $post->slug,
                        'subtitle' => $post->subtitle, // Tambahkan ini
                        'content' => $post->content,
                        'image' => $post->image ? asset('storage/' . $post->image) : null,
                        'author_image' => $post->author_image ? asset('storage/' . $post->author_image) : null,
                        'category' => $post->category,
                        'type' => $post->type,
                        'author' => $post->author,
                        'tags' => $post->tags,
                        'navigation_sections' => $post->navigation_sections ?? [],
                        'published_at' => $post->published_at ? $post->published_at->format('Y-m-d H:i:s') : null,
                        'created_at' => $post->created_at->format('Y-m-d H:i:s'),
                    ];
                });

            return $this->successResponse($posts);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch posts', 500, $e->getMessage());
        }
    }

    public function news(): JsonResponse
    {
        try {
            $news = Post::published()
                ->byType('news')
                ->latest()
                ->paginate(9)
                ->through(function ($post) {
                    return [
                        'id' => $post->id,
                        'title' => $post->title,
                        'slug' => $post->slug,
                        'subtitle' => $post->subtitle,
                        'content' => $post->content,
                        'image' => $post->image ? asset('storage/' . $post->image) : null,
                        'author_image' => $post->author_image ? asset('storage/' . $post->author_image) : null,
                        'category' => $post->category,
                        'author' => $post->author,
                        'tags' => $post->tags,
                        'navigation_sections' => $post->navigation_sections ?? [],
                        'published_at' => $post->published_at ? $post->published_at->format('Y-m-d H:i:s') : null,
                        'created_at' => $post->created_at->format('Y-m-d H:i:s'),
                    ];
                });

            return response()->json([
                'data' => $news->items(),
                'current_page' => $news->currentPage(),
                'last_page' => $news->lastPage(),
                'per_page' => $news->perPage(),
                'total' => $news->total(),
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch news', 500, $e->getMessage());
        }
    }

    public function articles(): JsonResponse
    {
        try {
            $articles = Post::published()
                ->byType('article')
                ->latest()
                ->paginate(9)
                ->through(function ($post) {
                    return [
                        'id' => $post->id,
                        'title' => $post->title,
                        'slug' => $post->slug,
                        'subtitle' => $post->subtitle,
                        'content' => $post->content,
                        'image' => $post->image ? asset('storage/' . $post->image) : null,
                        'author_image' => $post->author_image ? asset('storage/' . $post->author_image) : null,
                        'category' => $post->category,
                        'author' => $post->author,
                        'tags' => $post->tags,
                        'navigation_sections' => $post->navigation_sections ?? [],
                        'published_at' => $post->published_at ? $post->published_at->format('Y-m-d H:i:s') : null,
                        'created_at' => $post->created_at->format('Y-m-d H:i:s'),
                    ];
                });

            return response()->json([
                'data' => $articles->items(),
                'current_page' => $articles->currentPage(),
                'last_page' => $articles->lastPage(),
                'per_page' => $articles->perPage(),
                'total' => $articles->total(),
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch articles', 500, $e->getMessage());
        }
    }

    public function show($slug): JsonResponse
    {
        try {
            $post = Post::published()->where('slug', $slug)->first();

            if (!$post) {
                return $this->notFoundResponse('Post not found');
            }

            $data = [
                'id' => $post->id,
                'title' => $post->title,
                'slug' => $post->slug,
                'subtitle' => $post->subtitle, // Tambahkan ini
                'content' => $post->content,
                'image' => $post->image ? asset('storage/' . $post->image) : null,
                'author_image' => $post->author_image ? asset('storage/' . $post->author_image) : null,
                'category' => $post->category,
                'type' => $post->type,
                'author' => $post->author,
                'tags' => $post->tags,
                'meta_description' => $post->meta_description,
                'navigation_sections' => $post->navigation_sections ?? [],
                'published_at' => $post->published_at ? $post->published_at->format('Y-m-d H:i:s') : null,
                'created_at' => $post->created_at->format('Y-m-d H:i:s'),
            ];

            return $this->successResponse($data);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch post', 500, $e->getMessage());
        }
    }
}
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Models\PrestasiSettings;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

class PrestasiController extends ApiController
{
    public function settings(): JsonResponse
    {
        try {
            $settings = PrestasiSettings::active()->first();
            return $this->successResponse($settings);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch settings', 500, $e->getMessage());
        }
    }

    public function rightImage(): JsonResponse
    {
        try {
            $post = Post::published()
                ->whereJsonContains('tags', 'prestasi')
                ->latest()
                ->first();

            if (!$post) {
                return $this->successResponse(null);
            }

            return $this->successResponse([
                'image' => $post->image ? asset('storage/' . $post->image) : null,
                'title' => $post->title,
                'slug' => $post->slug,
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch right image', 500, $e->getMessage());
        }
    }

    public function listPrestasi(): JsonResponse
    {
        try {
            $posts = Post::published()
                ->whereJsonContains('tags', 'prestasi')
                ->latest()
                ->take(20)
                ->get()
                ->map(function ($post) {
                    return [
                        'id' => $post->id,
                        'title' => $post->title,
                        'slug' => $post->slug,
                        'subtitle' => $post->subtitle,
                        'image' => $post->image ? asset('storage/' . $post->image) : null,
                        'author_image' => $post->author_image ? asset('storage/' . $post->author_image) : null,
                        'category' => $post->category,
                        'author' => $post->author,
                        'tags' => $post->tags,
                        'published_at' => optional($post->published_at)->format('Y-m-d H:i:s'),
                    ];
                });

            return $this->successResponse($posts);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch prestasi list', 500, $e->getMessage());
        }
    }

    public function listTahfidz(): JsonResponse
    {
        try {
            $posts = Post::published()
                ->whereJsonContains('tags', 'ujian tahfidz')
                ->latest()
                ->take(20)
                ->get()
                ->map(function ($post) {
                    return [
                        'id' => $post->id,
                        'title' => $post->title,
                        'slug' => $post->slug,
                        'subtitle' => $post->subtitle,
                        'image' => $post->image ? asset('storage/' . $post->image) : null,
                        'author_image' => $post->author_image ? asset('storage/' . $post->author_image) : null,
                        'category' => $post->category,
                        'author' => $post->author,
                        'tags' => $post->tags,
                        'published_at' => optional($post->published_at)->format('Y-m-d H:i:s'),
                    ];
                });

            return $this->successResponse($posts);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch tahfidz list', 500, $e->getMessage());
        }
    }

    public function complete(): JsonResponse
    {
        try {
            $settings = PrestasiSettings::active()->first();
            $rightImage = Post::published()->whereJsonContains('tags', 'prestasi')->latest()->first();
            $prestasi = Post::published()->whereJsonContains('tags', 'prestasi')->latest()->take(20)->get();
            $tahfidz = Post::published()->whereJsonContains('tags', 'ujian tahfidz')->latest()->take(20)->get();

            return $this->successResponse([
                'settings' => $settings,
                'right_image' => $rightImage ? [
                    'image' => $rightImage->image ? asset('storage/' . $rightImage->image) : null,
                    'title' => $rightImage->title,
                    'slug' => $rightImage->slug,
                ] : null,
                'prestasi' => $prestasi->map(function ($post) {
                    return [
                        'id' => $post->id,
                        'title' => $post->title,
                        'slug' => $post->slug,
                        'subtitle' => $post->subtitle,
                        'image' => $post->image ? asset('storage/' . $post->image) : null,
                        'author_image' => $post->author_image ? asset('storage/' . $post->author_image) : null,
                        'category' => $post->category,
                        'author' => $post->author,
                        'tags' => $post->tags,
                        'published_at' => optional($post->published_at)->format('Y-m-d H:i:s'),
                    ];
                }),
                'tahfidz' => $tahfidz->map(function ($post) {
                    return [
                        'id' => $post->id,
                        'title' => $post->title,
                        'slug' => $post->slug,
                        'subtitle' => $post->subtitle,
                        'image' => $post->image ? asset('storage/' . $post->image) : null,
                        'author_image' => $post->author_image ? asset('storage/' . $post->author_image) : null,
                        'category' => $post->category,
                        'author' => $post->author,
                        'tags' => $post->tags,
                        'published_at' => optional($post->published_at)->format('Y-m-d H:i:s'),
                    ];
                }),
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch prestasi complete', 500, $e->getMessage());
        }
    }
} 
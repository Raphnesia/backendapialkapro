<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PrestasiSettings;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    public function settings()
    {
        $settings = PrestasiSettings::first();
        
        return response()->json([
            'main_heading' => $settings->main_heading ?? 'Prestasi Sekolah',
            'hero_background_color' => $settings->hero_background_color ?? '#1e40af',
            'hero_text_color' => $settings->hero_text_color ?? '#ffffff',
        ]);
    }

    public function rightImage()
    {
        $post = Post::whereJsonContains('tags', 'prestasi')
            ->where('is_published', true)
            ->latest()
            ->first();

        if (!$post) {
            return response()->json([
                'message' => 'Tidak ada berita prestasi yang tersedia'
            ], 404);
        }

        return response()->json([
            'id' => $post->id,
            'title' => $post->title,
            'excerpt' => $post->excerpt,
            'image' => $post->getFirstMediaUrl('featured_image'),
            'published_at' => $post->published_at,
        ]);
    }

    public function listPrestasi()
    {
        $posts = Post::whereJsonContains('tags', 'prestasi')
            ->where('is_published', true)
            ->latest()
            ->paginate(10);

        return response()->json([
            'data' => $posts->items(),
            'pagination' => [
                'current_page' => $posts->currentPage(),
                'last_page' => $posts->lastPage(),
                'per_page' => $posts->perPage(),
                'total' => $posts->total(),
            ]
        ]);
    }

    public function listTahfidz()
    {
        $posts = Post::whereJsonContains('tags', 'ujian tahfidz')
            ->where('is_published', true)
            ->latest()
            ->paginate(10);

        return response()->json([
            'data' => $posts->items(),
            'pagination' => [
                'current_page' => $posts->currentPage(),
                'last_page' => $posts->lastPage(),
                'per_page' => $posts->perPage(),
                'total' => $posts->total(),
            ]
        ]);
    }

    public function complete()
    {
        $settings = PrestasiSettings::first();
        $rightImage = Post::whereJsonContains('tags', 'prestasi')
            ->where('is_published', true)
            ->latest()
            ->first();
        $prestasiList = Post::whereJsonContains('tags', 'prestasi')
            ->where('is_published', true)
            ->latest()
            ->take(5)
            ->get();
        $tahfidzList = Post::whereJsonContains('tags', 'ujian tahfidz')
            ->where('is_published', true)
            ->latest()
            ->take(5)
            ->get();

        return response()->json([
            'settings' => [
                'main_heading' => $settings->main_heading ?? 'Prestasi Sekolah',
                'hero_background_color' => $settings->hero_background_color ?? '#1e40af',
                'hero_text_color' => $settings->hero_text_color ?? '#ffffff',
            ],
            'right_image' => $rightImage ? [
                'id' => $rightImage->id,
                'title' => $rightImage->title,
                'excerpt' => $rightImage->excerpt,
                'image' => $rightImage->getFirstMediaUrl('featured_image'),
                'published_at' => $rightImage->published_at,
            ] : null,
            'prestasi_list' => $prestasiList->map(function ($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'excerpt' => $post->excerpt,
                    'image' => $post->getFirstMediaUrl('featured_image'),
                    'published_at' => $post->published_at,
                ];
            }),
            'tahfidz_list' => $tahfidzList->map(function ($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'excerpt' => $post->excerpt,
                    'image' => $post->getFirstMediaUrl('featured_image'),
                    'published_at' => $post->published_at,
                ];
            }),
        ]);
    }
} 
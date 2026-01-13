<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Models\ProfileSection;
use Illuminate\Http\JsonResponse;

class ProfileSectionController extends ApiController
{
    public function index(): JsonResponse
    {
        try {
            $sections = ProfileSection::active()
                ->ordered()
                ->get()
                ->map(function ($section) {
                    return [
                        'id' => $section->id,
                        'title' => $section->title,
                        'slug' => $section->slug,
                        'content' => $section->content,
                        'image' => $section->image ? asset('storage/' . $section->image) : null,
                        'order_index' => $section->order_index,
                        'icon' => $section->icon,
                        'subtitle' => $section->subtitle,
                    ];
                });

            return $this->successResponse($sections);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch profile sections', 500, $e->getMessage());
        }
    }

    public function show($slug): JsonResponse
    {
        try {
            $section = ProfileSection::active()->where('slug', $slug)->first();

            if (!$section) {
                return $this->notFoundResponse('Profile section not found');
            }

            $data = [
                'id' => $section->id,
                'title' => $section->title,
                'slug' => $section->slug,
                'content' => $section->content,
                'image' => $section->image ? asset('storage/' . $section->image) : null,
                'order_index' => $section->order_index,
                'icon' => $section->icon,
                'subtitle' => $section->subtitle,
            ];

            return $this->successResponse($data);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch profile section', 500, $e->getMessage());
        }
    }
}
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Models\HomeHeroVideo;
use Illuminate\Http\JsonResponse;

class HomeHeroVideoController extends ApiController
{
    public function index(): JsonResponse
    {
        try {
            $videos = HomeHeroVideo::ordered()->get()->map(fn ($v) => $this->mapVideo($v));
            return $this->successResponse($videos);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch hero videos', 500, $e->getMessage());
        }
    }

    public function active(): JsonResponse
    {
        try {
            $videos = HomeHeroVideo::active()->ordered()->get()->map(fn ($v) => $this->mapVideo($v));
            return $this->successResponse($videos);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch active hero videos', 500, $e->getMessage());
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            $video = HomeHeroVideo::find($id);
            if (!$video) {
                return $this->notFoundResponse('Hero video not found');
            }
            return $this->successResponse($this->mapVideo($video));
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch hero video', 500, $e->getMessage());
        }
    }

    private function mapVideo(HomeHeroVideo $v): array
    {
        $desktop = $v->source_type === 'upload' ? $v->video_file : ($v->video_url ?? null);
        $mobile = $v->source_type === 'upload' ? $v->mobile_video_file : ($v->mobile_video_url ?? null);
        return [
            'id' => $v->id,
            'title' => $v->title,
            'source_type' => $v->source_type,
            'video_desktop' => $desktop,
            'video_mobile' => $mobile,
            'poster_image' => $v->poster_image,
            'is_active' => $v->is_active,
            'order_index' => $v->order_index,
        ];
    }
} 
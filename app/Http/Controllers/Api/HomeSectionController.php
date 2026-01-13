<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Models\HomeSection;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class HomeSectionController extends ApiController
{
    private array $fileKeys = [
        'video_file_desktop', 'video_file_mobile', 'poster_image', 'background_image',
        'image', 'icon_upload', 'video_file', 'principal_photo'
    ];

    private function mapStorageUrl(?string $value): ?string
    {
        if (!$value) {
            return null;
        }
        if (preg_match('/^https?:\/\//i', $value)) {
            return $value;
        }
        return asset('storage/' . ltrim($value, '/'));
    }

    private function transformConfigData($data)
    {
        if (is_array($data)) {
            $isAssoc = array_keys($data) !== range(0, count($data) - 1);
            if ($isAssoc) {
                foreach ($data as $key => $val) {
                    if (is_string($val) && in_array($key, $this->fileKeys, true)) {
                        $data[$key] = $this->mapStorageUrl($val);
                    } else {
                        $data[$key] = $this->transformConfigData($val);
                    }
                }
            } else {
                foreach ($data as $idx => $val) {
                    $data[$idx] = $this->transformConfigData($val);
                }
            }
        }
        return $data;
    }

    public function byType(string $sectionType): JsonResponse
    {
        try {
            $sections = HomeSection::active()
                ->byType($sectionType)
                ->ordered()
                ->get()
                ->map(function ($section) {
                    return [
                        'id' => $section->id,
                        'title' => $section->title,
                        'content' => $section->content,
                        'image' => $section->image ? asset('storage/' . $section->image) : null,
                        'order_index' => $section->order_index,
                        'section_type' => $section->section_type,
                        'config_data' => $this->transformConfigData($section->config_data ?? []),
                    ];
                });

            return $this->successResponse($sections);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch home sections by type', 500, $e->getMessage());
        }
    }
    public function index(): JsonResponse
    {
        try {
            $sections = HomeSection::active()
                ->ordered()
                ->get()
                ->map(function ($section) {
                    return [
                        'id' => $section->id,
                        'title' => $section->title,
                        'content' => $section->content,
                        'image' => $section->image ? asset('storage/' . $section->image) : null,
                        'order_index' => $section->order_index,
                        'section_type' => $section->section_type,
                        'config_data' => $this->transformConfigData($section->config_data ?? []),
                    ];
                });

            return $this->successResponse($sections);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch home sections', 500, $e->getMessage());
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $section = HomeSection::active()->find($id);

            if (!$section) {
                return $this->notFoundResponse('Home section not found');
            }

            $data = [
                'id' => $section->id,
                'title' => $section->title,
                'content' => $section->content,
                'image' => $section->image ? asset('storage/' . $section->image) : null,
                'order_index' => $section->order_index,
                'section_type' => $section->section_type,
                'config_data' => $section->config_data,
            ];

            return $this->successResponse($data);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch home section', 500, $e->getMessage());
        }
    }
}
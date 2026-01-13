<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Models\Facility;
use App\Models\FacilitySettings;
use App\Models\FacilityBox;
use App\Models\SubFacility;
use App\Models\SubFacilitySettings;
use App\Models\SubFacilityBox;
use App\Models\SubFacilityPhoto;
use App\Models\FacilityContent;
use App\Models\FacilityPhoto;
use Illuminate\Http\JsonResponse;

class FacilityController extends ApiController
{
    // Get main facility page data (settings + boxes + facilities)
    public function index(): JsonResponse
    {
        try {
            $settings = FacilitySettings::active()->first();
            $content = FacilityContent::active()->ordered()->get();
            $photos = FacilityPhoto::active()->ordered()->get();
            $boxes = FacilityBox::active()->ordered()->get();
            $facilities = Facility::active()->ordered()->get()->map(function ($facility) {
                    return [
                        'id' => $facility->id,
                        'name' => $facility->name,
                        'slug' => $facility->slug,
                        'description' => $facility->description,
                        'image' => $facility->image ? asset('storage/' . $facility->image) : null,
                        'category' => $facility->category,
                        'capacity' => $facility->capacity,
                        'location' => $facility->location,
                        'specifications' => $facility->specifications,
                        'order_index' => $facility->order_index,
                    ];
                });

            return $this->successResponse([
                'settings' => $settings,
                'content' => $content,
                'photos' => $photos,
                'boxes' => $boxes,
                'facilities' => $facilities
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch facility data', 500, $e->getMessage());
        }
    }

    // Get facility settings only
    public function settings(): JsonResponse
    {
        try {
            $settings = FacilitySettings::active()->first();
            
            if (!$settings) {
                return $this->notFoundResponse('Facility settings not found');
            }

            return $this->successResponse($settings);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch facility settings', 500, $e->getMessage());
        }
    }

    // Get facility boxes only
    public function boxes(): JsonResponse
    {
        try {
            $boxes = FacilityBox::active()->ordered()->get();
            return $this->successResponse($boxes);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch facility boxes', 500, $e->getMessage());
        }
    }

    // Get single facility
    public function show($slug): JsonResponse
    {
        try {
            $facility = Facility::active()->where('slug', $slug)->first();

            if (!$facility) {
                return $this->notFoundResponse('Facility not found');
            }

            $data = [
                'id' => $facility->id,
                'name' => $facility->name,
                'slug' => $facility->slug,
                'description' => $facility->description,
                'image' => $facility->image ? asset('storage/' . $facility->image) : null,
                'category' => $facility->category,
                'capacity' => $facility->capacity,
                'location' => $facility->location,
                'specifications' => $facility->specifications,
                'order_index' => $facility->order_index,
            ];

            return $this->successResponse($data);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch facility', 500, $e->getMessage());
        }
    }

    // Get sub-facility data (for dynamic sub-facilities)
    public function subFacility($parentSlug): JsonResponse
    {
        try {
            $settings = SubFacilitySettings::active()->byParentSlug($parentSlug)->first();
            $boxes = SubFacilityBox::active()->byParentSlug($parentSlug)->ordered()->get();
            $photos = SubFacilityPhoto::active()->byParentSlug($parentSlug)->ordered()->get();
            $facilities = SubFacility::active()->byParentSlug($parentSlug)->ordered()->get()->map(function ($facility) {
                return [
                    'id' => $facility->id,
                    'name' => $facility->name,
                    'slug' => $facility->slug,
                    'description' => $facility->description,
                    'image' => $facility->image ? asset('storage/' . $facility->image) : null,
                    'category' => $facility->category,
                    'capacity' => $facility->capacity,
                    'location' => $facility->location,
                    'specifications' => $facility->specifications,
                    'order_index' => $facility->order_index,
                ];
            });

            if (!$settings) {
                return $this->notFoundResponse('Sub-facility not found');
            }

            return $this->successResponse([
                'settings' => $settings,
                'boxes' => $boxes,
                'photos' => $photos,
                'facilities' => $facilities
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch sub-facility data', 500, $e->getMessage());
        }
    }

    // Get single sub-facility
    public function subFacilityShow($parentSlug, $slug): JsonResponse
    {
        try {
            $facility = SubFacility::active()
                ->byParentSlug($parentSlug)
                ->where('slug', $slug)
                ->first();

            if (!$facility) {
                return $this->notFoundResponse('Sub-facility not found');
            }

            $data = [
                'id' => $facility->id,
                'name' => $facility->name,
                'slug' => $facility->slug,
                'description' => $facility->description,
                'image' => $facility->image ? asset('storage/' . $facility->image) : null,
                'category' => $facility->category,
                'capacity' => $facility->capacity,
                'location' => $facility->location,
                'specifications' => $facility->specifications,
                'order_index' => $facility->order_index,
            ];

            return $this->successResponse($data);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch sub-facility', 500, $e->getMessage());
        }
    }

    // Get sub-facility by category
    public function subFacilityByCategory($parentSlug, $category): JsonResponse
    {
        try {
            $facilities = SubFacility::active()
                ->byParentSlug($parentSlug)
                ->byCategory($category)
                ->ordered()
                ->get()
                ->map(function ($facility) {
                    return [
                        'id' => $facility->id,
                        'name' => $facility->name,
                        'slug' => $facility->slug,
                        'description' => $facility->description,
                        'image' => $facility->image ? asset('storage/' . $facility->image) : null,
                        'category' => $facility->category,
                        'capacity' => $facility->capacity,
                        'location' => $facility->location,
                        'specifications' => $facility->specifications,
                        'order_index' => $facility->order_index,
                    ];
                });

            return $this->successResponse($facilities);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch sub-facilities by category', 500, $e->getMessage());
        }
    }
}
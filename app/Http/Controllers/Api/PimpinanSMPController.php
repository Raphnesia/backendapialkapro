<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Models\PimpinanSMP;
use App\Models\PimpinanSMPBox;
use App\Models\PimpinanSMPSettings;
use Illuminate\Http\JsonResponse;

class PimpinanSMPController extends ApiController
{
    public function index(): JsonResponse
    {
        try {
            $pimpinan = PimpinanSMP::active()
                ->ordered()
                ->get()
                ->map(function ($pimpinan) {
                    return [
                        'id' => $pimpinan->id,
                        'name' => $pimpinan->name,
                        'position' => $pimpinan->position,
                        'photo' => $pimpinan->photo ? asset('storage/' . $pimpinan->photo) : null,
                        'bio' => $pimpinan->bio,
                        'education' => $pimpinan->education,
                        'experience' => $pimpinan->experience,
                        'type' => $pimpinan->type,
                        'order_index' => $pimpinan->order_index,
                        'banner_desktop' => $pimpinan->banner_desktop ? asset('storage/' . $pimpinan->banner_desktop) : null,
                        'banner_mobile' => $pimpinan->banner_mobile ? asset('storage/' . $pimpinan->banner_mobile) : null,
                    ];
                });

            return $this->successResponse($pimpinan);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch pimpinan SMP', 500, $e->getMessage());
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $pimpinan = PimpinanSMP::findOrFail($id);
            
            $data = [
                'id' => $pimpinan->id,
                'name' => $pimpinan->name,
                'position' => $pimpinan->position,
                'photo' => $pimpinan->photo ? asset('storage/' . $pimpinan->photo) : null,
                'bio' => $pimpinan->bio,
                'education' => $pimpinan->education,
                'experience' => $pimpinan->experience,
                'type' => $pimpinan->type,
                'order_index' => $pimpinan->order_index,
                'banner_desktop' => $pimpinan->banner_desktop ? asset('storage/' . $pimpinan->banner_desktop) : null,
                'banner_mobile' => $pimpinan->banner_mobile ? asset('storage/' . $pimpinan->banner_mobile) : null,
            ];

            return $this->successResponse($data);
        } catch (\Exception $e) {
            return $this->errorResponse('Pimpinan SMP not found', 404, $e->getMessage());
        }
    }

    public function byType($type): JsonResponse
    {
        try {
            $pimpinan = PimpinanSMP::active()
                ->where('type', 'LIKE', '%' . $type . '%')
                ->ordered()
                ->get()
                ->map(function ($pimpinan) {
                    return [
                        'id' => $pimpinan->id,
                        'name' => $pimpinan->name,
                        'position' => $pimpinan->position,
                        'photo' => $pimpinan->photo ? asset('storage/' . $pimpinan->photo) : null,
                        'bio' => $pimpinan->bio,
                        'education' => $pimpinan->education,
                        'experience' => $pimpinan->experience,
                        'type' => $pimpinan->type,
                        'order_index' => $pimpinan->order_index,
                        'banner_desktop' => $pimpinan->banner_desktop ? asset('storage/' . $pimpinan->banner_desktop) : null,
                        'banner_mobile' => $pimpinan->banner_mobile ? asset('storage/' . $pimpinan->banner_mobile) : null,
                    ];
                });

            return $this->successResponse($pimpinan);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch pimpinan SMP by type', 500, $e->getMessage());
        }
    }

    public function kepalaSekolah(): JsonResponse
    {
        try {
            $pimpinan = PimpinanSMP::active()
                ->where('type', 'LIKE', '%Kepala Sekolah%')
                ->ordered()
                ->get()
                ->map(function ($pimpinan) {
                    return [
                        'id' => $pimpinan->id,
                        'name' => $pimpinan->name,
                        'position' => $pimpinan->position,
                        'photo' => $pimpinan->photo ? asset('storage/' . $pimpinan->photo) : null,
                        'bio' => $pimpinan->bio,
                        'education' => $pimpinan->education,
                        'experience' => $pimpinan->experience,
                        'type' => $pimpinan->type,
                        'order_index' => $pimpinan->order_index,
                        'banner_desktop' => $pimpinan->banner_desktop ? asset('storage/' . $pimpinan->banner_desktop) : null,
                        'banner_mobile' => $pimpinan->banner_mobile ? asset('storage/' . $pimpinan->banner_mobile) : null,
                    ];
                });

            return $this->successResponse($pimpinan);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch kepala sekolah', 500, $e->getMessage());
        }
    }

    public function wakilKepalaSekolah(): JsonResponse
    {
        try {
            $pimpinan = PimpinanSMP::active()
                ->where('type', 'LIKE', '%Wakil Kepala Sekolah%')
                ->ordered()
                ->get()
                ->map(function ($pimpinan) {
                    return [
                        'id' => $pimpinan->id,
                        'name' => $pimpinan->name,
                        'position' => $pimpinan->position,
                        'photo' => $pimpinan->photo ? asset('storage/' . $pimpinan->photo) : null,
                        'bio' => $pimpinan->bio,
                        'education' => $pimpinan->education,
                        'experience' => $pimpinan->experience,
                        'type' => $pimpinan->type,
                        'order_index' => $pimpinan->order_index,
                        'banner_desktop' => $pimpinan->banner_desktop ? asset('storage/' . $pimpinan->banner_desktop) : null,
                        'banner_mobile' => $pimpinan->banner_mobile ? asset('storage/' . $pimpinan->banner_mobile) : null,
                    ];
                });

            return $this->successResponse($pimpinan);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch wakil kepala sekolah', 500, $e->getMessage());
        }
    }

    public function boxes(): JsonResponse
    {
        try {
            $boxes = PimpinanSMPBox::active()
                ->ordered()
                ->get()
                ->map(function ($box) {
                    return [
                        'id' => $box->id,
                        'title' => $box->title,
                        'description' => $box->description,
                        'icon' => $box->icon,
                        'image' => $box->image ? asset('storage/' . $box->image) : null,
                        'background_color' => $box->background_color,
                        'order_index' => $box->order_index,
                    ];
                });

            return $this->successResponse($boxes);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch keunggulan boxes', 500, $e->getMessage());
        }
    }

    public function settings(): JsonResponse
    {
        try {
            $settings = PimpinanSMPSettings::active()->first();
            
            if (!$settings) {
                return $this->errorResponse('Settings not found', 404);
            }

            $data = [
                'id' => $settings->id,
                'title' => $settings->title,
                'subtitle' => $settings->subtitle,
                'banner_desktop' => $settings->banner_desktop ? asset('storage/' . $settings->banner_desktop) : null,
                'banner_mobile' => $settings->banner_mobile ? asset('storage/' . $settings->banner_mobile) : null,
                'keunggulan_title' => $settings->keunggulan_title,
                'keunggulan_subtitle' => $settings->keunggulan_subtitle,
            ];

            return $this->successResponse($data);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch settings', 500, $e->getMessage());
        }
    }

    public function complete(): JsonResponse
    {
        try {
            // Get settings
            $settings = PimpinanSMPSettings::active()->first();
            
            // Get all pimpinan
            $pimpinan = PimpinanSMP::active()
                ->ordered()
                ->get()
                ->map(function ($pimpinan) {
                    return [
                        'id' => $pimpinan->id,
                        'name' => $pimpinan->name,
                        'position' => $pimpinan->position,
                        'photo' => $pimpinan->photo ? asset('storage/' . $pimpinan->photo) : null,
                        'bio' => $pimpinan->bio,
                        'education' => $pimpinan->education,
                        'experience' => $pimpinan->experience,
                        'type' => $pimpinan->type,
                        'order_index' => $pimpinan->order_index,
                        'banner_desktop' => $pimpinan->banner_desktop ? asset('storage/' . $pimpinan->banner_desktop) : null,
                        'banner_mobile' => $pimpinan->banner_mobile ? asset('storage/' . $pimpinan->banner_mobile) : null,
                    ];
                });

            // Get boxes
            $boxes = PimpinanSMPBox::active()
                ->ordered()
                ->get()
                ->map(function ($box) {
                    return [
                        'id' => $box->id,
                        'title' => $box->title,
                        'description' => $box->description,
                        'icon' => $box->icon,
                        'image' => $box->image ? asset('storage/' . $box->image) : null,
                        'background_color' => $box->background_color,
                        'order_index' => $box->order_index,
                    ];
                });

            $data = [
                'settings' => $settings ? [
                    'id' => $settings->id,
                    'title' => $settings->title,
                    'subtitle' => $settings->subtitle,
                    'banner_desktop' => $settings->banner_desktop ? asset('storage/' . $settings->banner_desktop) : null,
                    'banner_mobile' => $settings->banner_mobile ? asset('storage/' . $settings->banner_mobile) : null,
                    'keunggulan_title' => $settings->keunggulan_title,
                    'keunggulan_subtitle' => $settings->keunggulan_subtitle,
                ] : null,
                'pimpinan' => $pimpinan,
                'boxes' => $boxes,
            ];

            return $this->successResponse($data);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch complete data', 500, $e->getMessage());
        }
    }
} 
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Models\SchoolActivity;
use App\Models\SchoolActivitySettings;
use Illuminate\Http\JsonResponse;

class SchoolActivityController extends ApiController
{
    public function index(): JsonResponse
    {
        try {
            $activities = SchoolActivity::active()
                ->ordered()
                ->get()
                ->map(function ($activity) {
                    return [
                        'id' => $activity->id,
                        'title' => $activity->title,
                        'slug' => $activity->slug,
                        'description' => $activity->description,
                        'excerpt' => $activity->excerpt,
                        'image' => $activity->image ? asset('storage/' . $activity->image) : null,
                        'activity_date' => $activity->activity_date->format('Y-m-d'),
                        'activity_time' => $activity->activity_time ? $activity->activity_time->format('H:i') : null,
                        'date' => $activity->date ? $activity->date->format('d F Y') : null,
                        'location' => $activity->location,
                        'category' => $activity->category,
                        'participants' => $activity->participants,
                        'author' => $activity->author,
                        'type' => $activity->type,
                        'order_index' => $activity->order_index,
                    ];
                });

            return $this->successResponse($activities);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch activities', 500, $e->getMessage());
        }
    }

    public function show($slug): JsonResponse
    {
        try {
            $activity = SchoolActivity::active()->where('slug', $slug)->first();

            if (!$activity) {
                return $this->notFoundResponse('Activity not found');
            }

            $data = [
                'id' => $activity->id,
                'title' => $activity->title,
                'slug' => $activity->slug,
                'description' => $activity->description,
                'excerpt' => $activity->excerpt,
                'image' => $activity->image ? asset('storage/' . $activity->image) : null,
                'activity_date' => $activity->activity_date->format('Y-m-d'),
                'activity_time' => $activity->activity_time ? $activity->activity_time->format('H:i') : null,
                'date' => $activity->date ? $activity->date->format('d F Y') : null,
                'location' => $activity->location,
                'category' => $activity->category,
                'participants' => $activity->participants,
                'author' => $activity->author,
                'type' => $activity->type,
                'order_index' => $activity->order_index,
            ];

            return $this->successResponse($data);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch activity', 500, $e->getMessage());
        }
    }

    public function settings(): JsonResponse
    {
        try {
            $settings = SchoolActivitySettings::active()->first();

            if (!$settings) {
                return $this->notFoundResponse('Activity settings not found');
            }

            $data = [
                'id' => $settings->id,
                'title' => $settings->title,
                'subtitle' => $settings->subtitle,
                'banner_desktop' => $settings->banner_desktop,
                'banner_mobile' => $settings->banner_mobile,
            ];

            return $this->successResponse($data);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch activity settings', 500, $e->getMessage());
        }
    }

    public function complete(): JsonResponse
    {
        try {
            $settings = SchoolActivitySettings::active()->first();
            $activities = SchoolActivity::active()->ordered()->get();

            if (!$settings) {
                return $this->notFoundResponse('Activity settings not found');
            }

            return $this->successResponse([
                'settings' => $settings,
                'activities' => $activities,
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch complete activities data', 500, $e->getMessage());
        }
    }
}
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Models\Teacher;
use Illuminate\Http\JsonResponse;

class TeacherController extends ApiController
{
    public function index(): JsonResponse
    {
        try {
            $teachers = Teacher::active()
                ->ordered()
                ->get()
                ->map(function ($teacher) {
                    return [
                        'id' => $teacher->id,
                        'name' => $teacher->name,
                        'subject' => $teacher->subject,
                        'photo' => $teacher->photo ? asset('storage/' . $teacher->photo) : null,
                        'bio' => $teacher->bio,
                        'position' => $teacher->position,
                        'education' => $teacher->education,
                        'experience' => $teacher->experience,
                        'type' => $teacher->type,
                        'order_index' => $teacher->order_index,
                    ];
                });

            return $this->successResponse($teachers);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch teachers', 500, $e->getMessage());
        }
    }

    public function teachers(): JsonResponse
    {
        try {
            $teachers = Teacher::active()
                ->teachers()
                ->ordered()
                ->get()
                ->map(function ($teacher) {
                    return [
                        'id' => $teacher->id,
                        'name' => $teacher->name,
                        'subject' => $teacher->subject,
                        'photo' => $teacher->photo ? asset('storage/' . $teacher->photo) : null,
                        'bio' => $teacher->bio,
                        'position' => $teacher->position,
                        'education' => $teacher->education,
                        'experience' => $teacher->experience,
                        'order_index' => $teacher->order_index,
                    ];
                });

            return $this->successResponse($teachers);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch teachers', 500, $e->getMessage());
        }
    }

    public function staff(): JsonResponse
    {
        try {
            $staff = Teacher::active()
                ->staff()
                ->ordered()
                ->get()
                ->map(function ($staff) {
                    return [
                        'id' => $staff->id,
                        'name' => $staff->name,
                        'position' => $staff->position,
                        'photo' => $staff->photo ? asset('storage/' . $staff->photo) : null,
                        'bio' => $staff->bio,
                        'education' => $staff->education,
                        'experience' => $staff->experience,
                        'order_index' => $staff->order_index,
                    ];
                });

            return $this->successResponse($staff);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch staff', 500, $e->getMessage());
        }
    }

    public function bySubject(): JsonResponse
    {
        try {
            $teachers = Teacher::active()
                ->teachers()
                ->ordered()
                ->get()
                ->groupBy(function ($teacher) {
                    // Map subject names to lowercase keys for frontend
                    $subject = strtolower($teacher->subject);
                    return str_replace(' ', '_', $subject);
                })
                ->map(function ($teachers, $subjectKey) {
                    return $teachers->map(function ($teacher) {
                        return [
                            'name' => $teacher->name,
                            'image' => $teacher->photo ? asset('storage/' . $teacher->photo) : null,
                            'position' => $teacher->position,
                            'description' => $teacher->bio,
                            'subject' => $teacher->subject,
                        ];
                    });
                });

            return $this->successResponse($teachers);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch teachers by subject', 500, $e->getMessage());
        }
    }
}
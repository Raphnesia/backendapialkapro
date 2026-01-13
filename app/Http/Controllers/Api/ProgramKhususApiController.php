<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProgramKhususPage;
use App\Models\ProgramKhususType;
use Illuminate\Http\JsonResponse;

class ProgramKhususApiController extends Controller
{
    public function index(): JsonResponse
    {
        $page = ProgramKhususPage::active()->first();
        $types = ProgramKhususType::active()->get()->keyBy('slug');

        // Transform data to match frontend expectations
        $transformedPage = null;
        if ($page) {
            $transformedPage = [
                'id' => $page->id,
                'hero_title' => $page->hero_title,
                'hero_subtitle' => $page->hero_subtitle,
                'hero_image_desktop' => $page->hero_image_desktop,
                'hero_image_mobile' => $page->hero_image_mobile,
                'overview_title' => $page->overview_title,
                'overview_subtitle' => $page->overview_subtitle,
                'section_title' => $page->section_title,
                'section_subtitle' => $page->section_subtitle,
                'section_programs' => $page->section_programs,
                'programs' => $page->programs,
                'reasons_title' => $page->reasons_title,
                'reasons_subtitle' => $page->reasons_subtitle,
                'reasons' => $page->reasons,
                'cta_title' => $page->cta_title,
                'cta_subtitle' => $page->cta_subtitle,
                'cta_primary_label' => $page->cta_primary_label,
                'cta_primary_url' => $page->cta_primary_url,
                'cta_secondary_label' => $page->cta_secondary_label,
                'cta_secondary_url' => $page->cta_secondary_url,
                'is_active' => $page->is_active,
                'created_at' => $page->created_at,
                'updated_at' => $page->updated_at,
            ];
        }

        return response()->json([
            'success' => true,
            'data' => [
                'page' => $transformedPage,
                'types' => $types,
            ],
        ]);
    }

    public function type(string $slug): JsonResponse
    {
        $type = ProgramKhususType::where('slug', $slug)->active()->firstOrFail();
        return response()->json([
            'success' => true,
            'data' => $type,
        ]);
    }

    // List all types (including inactive)
    public function listTypes(): JsonResponse
    {
        $types = ProgramKhususType::query()->orderBy('updated_at', 'desc')->get();
        return response()->json(['success' => true, 'data' => $types]);
    }

    // Create ProgramKhususPage record
    public function createPage(\Illuminate\Http\Request $request): JsonResponse
    {
        $validated = $request->validate([
            'hero_title' => ['nullable', 'string', 'max:255'],
            'hero_subtitle' => ['nullable', 'string'],
            'hero_image_desktop' => ['nullable', 'string', 'max:255'],
            'hero_image_mobile' => ['nullable', 'string', 'max:255'],
            'overview_title' => ['nullable', 'string', 'max:255'],
            'overview_subtitle' => ['nullable', 'string'],
            'programs' => ['nullable', 'array'],
            'reasons' => ['nullable', 'array'],
            'cta' => ['nullable', 'array'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $page = ProgramKhususPage::create($validated);
        return response()->json(['success' => true, 'data' => $page], 201);
    }

    // Update ProgramKhususPage by id
    public function updatePage(\Illuminate\Http\Request $request, int $id): JsonResponse
    {
        $page = ProgramKhususPage::findOrFail($id);
        $validated = $request->validate([
            'hero_title' => ['nullable', 'string', 'max:255'],
            'hero_subtitle' => ['nullable', 'string'],
            'hero_image_desktop' => ['nullable', 'string', 'max:255'],
            'hero_image_mobile' => ['nullable', 'string', 'max:255'],
            'overview_title' => ['nullable', 'string', 'max:255'],
            'overview_subtitle' => ['nullable', 'string'],
            'programs' => ['nullable', 'array'],
            'reasons' => ['nullable', 'array'],
            'cta' => ['nullable', 'array'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $page->update($validated);
        return response()->json(['success' => true, 'data' => $page]);
    }

    public function deletePage(int $id): JsonResponse
    {
        $page = ProgramKhususPage::findOrFail($id);
        $page->delete();
        return response()->json(['success' => true]);
    }

    // Create new ProgramKhususType
    public function createType(\Illuminate\Http\Request $request): JsonResponse
    {
        $validated = $request->validate([
            'slug' => ['required', 'string', 'max:64', 'unique:program_khusus_types,slug'],
            'title' => ['nullable', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string'],
            'banner_desktop' => ['nullable', 'string', 'max:255'],
            'banner_mobile' => ['nullable', 'string', 'max:255'],
            'blocks' => ['nullable', 'array'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $type = ProgramKhususType::create($validated);
        return response()->json(['success' => true, 'data' => $type], 201);
    }

    // Update existing ProgramKhususType by slug
    public function updateType(\Illuminate\Http\Request $request, string $slug): JsonResponse
    {
        $type = ProgramKhususType::where('slug', $slug)->firstOrFail();
        $validated = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string'],
            'banner_desktop' => ['nullable', 'string', 'max:255'],
            'banner_mobile' => ['nullable', 'string', 'max:255'],
            'blocks' => ['nullable', 'array'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $type->update($validated);
        return response()->json(['success' => true, 'data' => $type]);
    }

    public function deleteType(string $slug): JsonResponse
    {
        $type = ProgramKhususType::where('slug', $slug)->firstOrFail();
        $type->delete();
        return response()->json(['success' => true]);
    }
}



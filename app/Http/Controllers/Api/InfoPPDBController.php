<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InfoPPDBSettings;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InfoPPDBController extends Controller
{
    public function settings(): JsonResponse
    {
        $settings = InfoPPDBSettings::getSettings();

        // Bentuk response map ke struktur frontend /info-ppdb
        $data = [
            'hero' => [
                'title' => $settings->title,
                'subtitle' => $settings->subtitle,
                'banner_desktop' => $settings->banner_desktop,
                'banner_mobile' => $settings->banner_mobile,
                'description' => $settings->hero_description,
                'cta' => [
                    'text' => $settings->cta_text,
                    'link' => $settings->cta_link,
                ],
            ],
            'introduction' => [
                'badge' => $settings->intro_badge,
                'title' => $settings->intro_title,
                'subtitle' => $settings->intro_subtitle,
            ],
            'featured' => [
                'image' => $settings->featured_image,
                'overlay_title' => $settings->featured_overlay_title,
                'overlay_desc' => $settings->featured_overlay_desc,
                'badge' => $settings->featured_badge,
            ],
            'key_points' => $settings->key_points ?? [],
            'alur' => [
                'title' => $settings->alur_title,
                'subtitle' => $settings->alur_subtitle,
                'image' => $settings->alur_image,
                'steps' => $settings->steps ?? [],
            ],
            'program_options' => [
                'badge' => $settings->program_section_badge,
                'title' => $settings->program_section_title,
                'subtitle' => $settings->program_section_subtitle,
                'rows' => $settings->program_rows ?? [],
            ],
            'cta_footer' => [
                'background' => $settings->cta_background,
                'badge' => $settings->cta_badge,
                'title' => $settings->cta_title,
                'description' => $settings->cta_description,
                'primary' => [
                    'label' => $settings->cta_primary_label,
                    'url' => $settings->cta_primary_url,
                ],
                'secondary' => [
                    'label' => $settings->cta_secondary_label,
                    'url' => $settings->cta_secondary_url,
                ],
                'contact_info' => $settings->contact_info,
            ],
            'meta' => [
                'registration_deadline' => optional($settings->registration_deadline)->toDateString(),
                'academic_year' => $settings->academic_year,
                'is_registration_open' => $settings->is_registration_open,
                'meta_description' => $settings->meta_description,
                'meta_keywords' => $settings->meta_keywords,
            ],
        ];

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    public function updateSettings(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string'],
            'banner_desktop' => ['nullable', 'string', 'max:255'],
            'banner_mobile' => ['nullable', 'string', 'max:255'],
            'hero_description' => ['nullable', 'string'],
            'cta_text' => ['nullable', 'string', 'max:255'],
            'cta_link' => ['nullable', 'string', 'max:255'],
            'contact_info' => ['nullable', 'string'],
            'registration_deadline' => ['nullable', 'date'],
            'academic_year' => ['nullable', 'string', 'max:32'],
            'is_registration_open' => ['nullable', 'boolean'],
            'meta_description' => ['nullable', 'string'],
            'meta_keywords' => ['nullable', 'string'],

            'intro_badge' => ['nullable', 'string', 'max:255'],
            'intro_title' => ['nullable', 'string', 'max:255'],
            'intro_subtitle' => ['nullable', 'string'],

            'featured_image' => ['nullable', 'string', 'max:255'],
            'featured_overlay_title' => ['nullable', 'string', 'max:255'],
            'featured_overlay_desc' => ['nullable', 'string'],
            'featured_badge' => ['nullable', 'string', 'max:255'],

            'key_points' => ['nullable', 'array'],
            'alur_title' => ['nullable', 'string', 'max:255'],
            'alur_subtitle' => ['nullable', 'string'],
            'alur_image' => ['nullable', 'string', 'max:255'],
            'steps' => ['nullable', 'array'],

            'program_section_badge' => ['nullable', 'string', 'max:255'],
            'program_section_title' => ['nullable', 'string', 'max:255'],
            'program_section_subtitle' => ['nullable', 'string'],
            'program_rows' => ['nullable', 'array'],

            'cta_background' => ['nullable', 'string', 'max:255'],
            'cta_badge' => ['nullable', 'string', 'max:255'],
            'cta_title' => ['nullable', 'string', 'max:255'],
            'cta_description' => ['nullable', 'string'],
            'cta_primary_label' => ['nullable', 'string', 'max:255'],
            'cta_primary_url' => ['nullable', 'string', 'max:255'],
            'cta_secondary_label' => ['nullable', 'string', 'max:255'],
            'cta_secondary_url' => ['nullable', 'string', 'max:255'],
        ]);

        $settings = InfoPPDBSettings::getSettings();
        if (!$settings->exists) {
            $settings = new InfoPPDBSettings();
        }
        $settings->fill($validated);
        $settings->save();

        return response()->json(['success' => true, 'data' => $settings]);
    }
}



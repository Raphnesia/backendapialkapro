<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProfilSettings;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    /**
     * Get profile settings
     */
    public function index()
    {
        $settings = ProfilSettings::getSettings();
        
        if (!$settings) {
            return response()->json([
                'success' => false,
                'message' => 'Profile settings not found',
                'data' => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Profile settings retrieved successfully',
            'data' => [
                'title' => $settings->title,
                'subtitle' => $settings->subtitle,
                'banner_desktop' => $settings->banner_desktop ? '/storage/' . $settings->banner_desktop : null,
                'banner_mobile' => $settings->banner_mobile ? '/storage/' . $settings->banner_mobile : null,
                'description' => $settings->description,
                'meta_description' => $settings->meta_description,
                'meta_keywords' => $settings->meta_keywords,
                'is_active' => $settings->is_active,
            ]
        ]);
    }

    /**
     * Update profile settings
     */
    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:500',
            'banner_desktop' => 'nullable|string',
            'banner_mobile' => 'nullable|string',
            'description' => 'nullable|string',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'is_active' => 'boolean',
        ]);

        $settings = ProfilSettings::first();
        
        if (!$settings) {
            $settings = new ProfilSettings();
        }

        $settings->fill($request->all());
        $settings->save();

        return response()->json([
            'success' => true,
            'message' => 'Profile settings updated successfully',
            'data' => $settings
        ]);
    }
}

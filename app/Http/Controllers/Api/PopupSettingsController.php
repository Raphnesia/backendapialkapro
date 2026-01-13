<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PopupSetting;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PopupSettingsController extends Controller
{
    public function index(): JsonResponse
    {
        $settings = PopupSetting::where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            })
            ->latest()
            ->first();

        if (!$settings) {
            return response()->json([
                'success' => true,
                'data' => [
                    'is_active' => false,
                    'image_url' => '',
                ]
            ]);
        }

        // Convert image_url to full URL if it's a storage path
        $data = $settings->toArray();
        if ($settings->image_url && !filter_var($settings->image_url, FILTER_VALIDATE_URL)) {
            $data['image_url'] = $settings->image_url_full;
        }

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'is_active' => 'required|boolean',
            'image_url' => 'required|string',
            'image_alt' => 'nullable|string',
            'link_url' => 'nullable|url',
            'open_in_new_tab' => 'nullable|boolean',
            'show_on_first_visit_only' => 'nullable|boolean',
            'delay_before_show' => 'nullable|integer|min:0',
            'expires_at' => 'nullable|date',
        ]);

        // Deactivate all existing popups
        PopupSetting::where('is_active', true)->update(['is_active' => false]);

        $settings = PopupSetting::create($validated);

        // Convert image_url to full URL if it's a storage path
        $data = $settings->toArray();
        if ($settings->image_url && !filter_var($settings->image_url, FILTER_VALIDATE_URL)) {
            $data['image_url'] = $settings->image_url_full;
        }

        return response()->json([
            'success' => true,
            'message' => 'Popup settings created successfully',
            'data' => $data
        ], 201);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $settings = PopupSetting::findOrFail($id);

        $validated = $request->validate([
            'is_active' => 'sometimes|boolean',
            'image_url' => 'sometimes|string',
            'image_alt' => 'nullable|string',
            'link_url' => 'nullable|url',
            'open_in_new_tab' => 'nullable|boolean',
            'show_on_first_visit_only' => 'nullable|boolean',
            'delay_before_show' => 'nullable|integer|min:0',
            'expires_at' => 'nullable|date',
        ]);

        $settings->update($validated);
        $settings->refresh();

        // Convert image_url to full URL if it's a storage path
        $data = $settings->toArray();
        if ($settings->image_url && !filter_var($settings->image_url, FILTER_VALIDATE_URL)) {
            $data['image_url'] = $settings->image_url_full;
        }

        return response()->json([
            'success' => true,
            'message' => 'Popup settings updated successfully',
            'data' => $data
        ]);
    }
}

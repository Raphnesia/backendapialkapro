<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SejarahSingkat;
use App\Models\SejarahSingkatSettings;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SejarahSingkatController extends Controller
{
    /**
     * Get all active sejarah singkat content
     */
    public function index(): JsonResponse
    {
        try {
            $sejarahSingkat = SejarahSingkat::active()
                ->ordered()
                ->get();

            return response()->json([
                'success' => true,
                'data' => $sejarahSingkat
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching sejarah singkat data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get single sejarah singkat by ID
     */
    public function show($id): JsonResponse
    {
        try {
            $sejarahSingkat = SejarahSingkat::active()->find($id);

            if (!$sejarahSingkat) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sejarah singkat not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $sejarahSingkat
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching sejarah singkat data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get sejarah singkat settings
     */
    public function settings(): JsonResponse
    {
        try {
            $settings = SejarahSingkatSettings::active()->first();

            if (!$settings) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sejarah singkat settings not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $settings
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching sejarah singkat settings',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get complete sejarah singkat data (content + settings)
     */
    public function complete(): JsonResponse
    {
        try {
            $settings = SejarahSingkatSettings::active()->first();
            $content = SejarahSingkat::active()->ordered()->get();

            if (!$settings) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sejarah singkat settings not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'settings' => $settings,
                    'content' => $content
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching complete sejarah singkat data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get sejarah singkat content by grid type
     */
    public function byGridType($gridType): JsonResponse
    {
        try {
            $sejarahSingkat = SejarahSingkat::active()
                ->where('grid_type', $gridType)
                ->ordered()
                ->get();

            return response()->json([
                'success' => true,
                'data' => $sejarahSingkat
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching sejarah singkat data by grid type',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get sejarah singkat content with list items
     */
    public function withListItems(): JsonResponse
    {
        try {
            $sejarahSingkat = SejarahSingkat::active()
                ->where('use_list_disc', true)
                ->ordered()
                ->get();

            return response()->json([
                'success' => true,
                'data' => $sejarahSingkat
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching sejarah singkat data with list items',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

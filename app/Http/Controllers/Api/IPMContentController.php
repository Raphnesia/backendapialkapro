<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\IPMContent;
use Illuminate\Http\Request;

class IPMContentController extends Controller
{
    public function index()
    {
        try {
            $content = IPMContent::active()->ordered()->get();
            
            return response()->json([
                'success' => true,
                'data' => $content
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $content = IPMContent::find($id);
            
            if (!$content) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan'
                ], 404);
            }
            
            return response()->json([
                'success' => true,
                'data' => $content
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function byGridType($gridType)
    {
        try {
            $content = IPMContent::active()
                ->where('grid_type', $gridType)
                ->ordered()
                ->get();
            
            return response()->json([
                'success' => true,
                'data' => $content
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function withListItems()
    {
        try {
            $content = IPMContent::active()
                ->where('use_list_disc', true)
                ->whereNotNull('list_items')
                ->ordered()
                ->get();
            
            return response()->json([
                'success' => true,
                'data' => $content
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
} 
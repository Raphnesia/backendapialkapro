<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HisbulWathan;
use App\Models\HisbulWathanSettings;
use App\Models\HisbulWathanContent;
use Illuminate\Http\Request;

class HisbulWathanController extends Controller
{
    public function index()
    {
        try {
            $items = HisbulWathan::active()->ordered()->get();
            return response()->json(['success' => true, 'data' => $items]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $item = HisbulWathan::find($id);
            if (!$item) {
                return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
            }
            return response()->json(['success' => true, 'data' => $item]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function settings()
    {
        try {
            $settings = HisbulWathanSettings::active()->first();
            if (!$settings) {
                return response()->json(['success' => false, 'message' => 'Pengaturan tidak ditemukan'], 404);
            }
            return response()->json(['success' => true, 'data' => $settings]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function complete()
    {
        try {
            $settings = HisbulWathanSettings::active()->first();
            $pengurus = HisbulWathan::active()->ordered()->get();
            $content = HisbulWathanContent::active()->ordered()->get();

            return response()->json([
                'success' => true,
                'data' => [
                    'settings' => $settings,
                    'pengurus' => $pengurus,
                    'content' => $content,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
} 
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TapakSuci;
use App\Models\TapakSuciSettings;
use App\Models\TapakSuciContent;
use Illuminate\Http\Request;

class TapakSuciController extends Controller
{
    public function index()
    {
        try {
            $items = TapakSuci::active()->ordered()->get();
            return response()->json(['success' => true, 'data' => $items]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $item = TapakSuci::find($id);
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
            $settings = TapakSuciSettings::active()->first();
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
            $settings = TapakSuciSettings::active()->first();
            $pengurus = TapakSuci::active()->ordered()->get();
            $content = TapakSuciContent::active()->ordered()->get();

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
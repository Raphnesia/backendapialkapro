<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ekstrakurikuler;
use App\Models\EkstrakurikulerSettings;
use Illuminate\Http\Request;

class EkstrakurikulerController extends Controller
{
    public function index()
    {
        try {
            $ekstrakurikuler = Ekstrakurikuler::active()->ordered()->get();
            
            return response()->json([
                'success' => true,
                'data' => $ekstrakurikuler
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
            $ekstrakurikuler = Ekstrakurikuler::active()->find($id);
            
            if (!$ekstrakurikuler) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan'
                ], 404);
            }
            
            return response()->json([
                'success' => true,
                'data' => $ekstrakurikuler
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function settings()
    {
        try {
            $settings = EkstrakurikulerSettings::active()->first();
            
            if (!$settings) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pengaturan tidak ditemukan'
                ], 404);
            }
            
            return response()->json([
                'success' => true,
                'data' => $settings
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function complete()
    {
        try {
            $settings = EkstrakurikulerSettings::active()->first();
            $ekstrakurikuler = Ekstrakurikuler::active()->ordered()->get();
            
            return response()->json([
                'success' => true,
                'data' => [
                    'settings' => $settings,
                    'content' => $ekstrakurikuler
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function byCategory($category)
    {
        try {
            $ekstrakurikuler = Ekstrakurikuler::active()
                ->byCategory($category)
                ->ordered()
                ->get();
            
            return response()->json([
                'success' => true,
                'data' => $ekstrakurikuler
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}

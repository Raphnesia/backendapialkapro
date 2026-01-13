<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VisiMisi;
use App\Models\VisiMisiSettings;
use Illuminate\Http\Request;

class VisiMisiController extends Controller
{
    public function index()
    {
        try {
            $visiMisi = VisiMisi::active()->ordered()->get();
            
            return response()->json([
                'success' => true,
                'data' => $visiMisi
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
            $visiMisi = VisiMisi::active()->find($id);
            
            if (!$visiMisi) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan'
                ], 404);
            }
            
            return response()->json([
                'success' => true,
                'data' => $visiMisi
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
            $settings = VisiMisiSettings::active()->first();
            
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
            $settings = VisiMisiSettings::active()->first();
            $visiMisi = VisiMisi::active()->ordered()->get();
            
            return response()->json([
                'success' => true,
                'data' => [
                    'settings' => $settings,
                    'content' => $visiMisi
                ]
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
            $visiMisi = VisiMisi::active()
                ->where('grid_type', $gridType)
                ->ordered()
                ->get();
            
            return response()->json([
                'success' => true,
                'data' => $visiMisi
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
            $visiMisi = VisiMisi::active()
                ->where('use_list_disc', true)
                ->ordered()
                ->get();
            
            return response()->json([
                'success' => true,
                'data' => $visiMisi
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}

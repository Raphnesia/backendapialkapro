<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\IPM;
use App\Models\IPMSettings;
use App\Models\IPMContent;
use Illuminate\Http\Request;

class IPMController extends Controller
{
    public function index()
    {
        try {
            $ipm = IPM::active()->ordered()->get();
            
            return response()->json([
                'success' => true,
                'data' => $ipm
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
            $ipm = IPM::find($id);
            
            if (!$ipm) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan'
                ], 404);
            }
            
            return response()->json([
                'success' => true,
                'data' => $ipm
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
            $settings = IPMSettings::active()->first();
            
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
            $settings = IPMSettings::active()->first();
            $pengurus = IPM::active()->ordered()->get();
            $content = IPMContent::active()->ordered()->get();
            
            return response()->json([
                'success' => true,
                'data' => [
                    'settings' => $settings,
                    'pengurus' => $pengurus,
                    'content' => $content
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}

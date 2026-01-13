<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StrukturOrganisasi;
use App\Models\StrukturOrganisasiSettings;
use App\Models\StrukturOrganisasiContent;
use Illuminate\Http\Request;

class StrukturOrganisasiController extends Controller
{
    public function index()
    {
        try {
            $strukturOrganisasi = StrukturOrganisasi::active()->ordered()->get();
            
            return response()->json([
                'success' => true,
                'data' => $strukturOrganisasi
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
            $strukturOrganisasi = StrukturOrganisasi::active()->find($id);
            
            if (!$strukturOrganisasi) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan'
                ], 404);
            }
            
            return response()->json([
                'success' => true,
                'data' => $strukturOrganisasi
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
            $settings = StrukturOrganisasiSettings::active()->first();
            
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
            $settings = StrukturOrganisasiSettings::active()->first();
            $strukturOrganisasi = StrukturOrganisasi::active()->ordered()->get();
            $content = StrukturOrganisasiContent::active()->ordered()->get();
            
            return response()->json([
                'success' => true,
                'data' => [
                    'settings' => $settings,
                    'struktur_organisasi' => $strukturOrganisasi,
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

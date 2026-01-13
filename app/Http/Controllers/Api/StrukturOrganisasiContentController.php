<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StrukturOrganisasiContent;
use Illuminate\Http\Request;

class StrukturOrganisasiContentController extends Controller
{
    public function index()
    {
        try {
            $content = StrukturOrganisasiContent::active()->ordered()->get();
            
            return response()->json([
                'success' => true,
                'data' => $content
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data content struktur organisasi',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $content = StrukturOrganisasiContent::findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => $content
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data content struktur organisasi tidak ditemukan',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function byGridType($gridType)
    {
        try {
            $content = StrukturOrganisasiContent::active()
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
                'message' => 'Gagal mengambil data content struktur organisasi',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function withBidangStructure()
    {
        try {
            $content = StrukturOrganisasiContent::active()
                ->where('use_list_disc', true)
                ->whereNotNull('bidang_structure')
                ->ordered()
                ->get();
            
            return response()->json([
                'success' => true,
                'data' => $content
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data content struktur organisasi',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function byDisplayType($displayType)
    {
        try {
            $content = StrukturOrganisasiContent::active()
                ->where('display_type', $displayType)
                ->ordered()
                ->get();
            
            return response()->json([
                'success' => true,
                'data' => $content
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data content struktur organisasi',
                'error' => $e->getMessage()
            ], 500);
        }
    }
} 
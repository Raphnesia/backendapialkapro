<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeacherSettingController extends Controller
{
    public function index(): JsonResponse
    {
        // Cari teacher yang memiliki guruData dengan active = true
        $teacher = Teacher::whereJsonContains('guruData->active', true)->first();
        
        if (!$teacher || !isset($teacher->guruData)) {
            // Jika tidak ada yang aktif, return default
            return response()->json([
                'success' => true,
                'data' => [
                    'title' => 'Guru & Staff',
                    'subtitle' => 'Mengenal lebih dekat dengan para pengajar dan staf kami',
                    'banner_desktop' => null,
                    'banner_mobile' => null,
                    'date' => 'Terbaru',
                    'read_time' => '3 min',
                    'author' => 'Admin',
                ]
            ]);
        }

        $guruData = $teacher->guruData;

        // PERBAIKAN: Ambil banner dari guruData, bukan field terpisah
        $bannerDesktop = null;
        $bannerMobile = null;

        if (!empty($guruData['banner_desktop'])) {
            // Cek apakah file ada di storage
            if (Storage::disk('public')->exists($guruData['banner_desktop'])) {
                $bannerDesktop = asset('storage/' . $guruData['banner_desktop']);
            }
        }

        if (!empty($guruData['banner_mobile'])) {
            // Cek apakah file ada di storage
            if (Storage::disk('public')->exists($guruData['banner_mobile'])) {
                $bannerMobile = asset('storage/' . $guruData['banner_mobile']);
            }
        }

        return response()->json([
            'success' => true,
            'data' => [
                'title' => $guruData['title'] ?? 'Guru & Staff',
                'subtitle' => $guruData['subtitle'] ?? 'Mengenal lebih dekat dengan para pengajar dan staf kami',
                'banner_desktop' => $bannerDesktop,
                'banner_mobile' => $bannerMobile,
                'date' => $guruData['date'] ?? 'Terbaru',
                'read_time' => $guruData['read_time'] ?? '3 min',
                'author' => $guruData['author'] ?? 'Admin',
            ]
        ]);
    }

    public function update(Request $request): JsonResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:500',
            'banner_desktop' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'banner_mobile' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'date' => 'required|string|max:100',
            'read_time' => 'required|string|max:50',
            'author' => 'required|string|max:100',
        ]);

        // Nonaktifkan semua pengaturan yang ada
        Teacher::query()->update([
            'guruData->active' => false
        ]);

        // Ambil teacher pertama atau buat baru
        $teacher = Teacher::first();
        if (!$teacher) {
            $teacher = new Teacher();
            $teacher->name = 'Default Teacher';
            $teacher->position = 'Default Position';
            $teacher->type = 'teacher';
            $teacher->is_active = true;
        }

        // Mulai dengan data yang ada (untuk preserve banner lama jika tidak diupdate)
        $guruData = $teacher->guruData ?? [];
        
        // Update data teks
        $guruData['title'] = $request->title;
        $guruData['subtitle'] = $request->subtitle;
        $guruData['date'] = $request->date;
        $guruData['read_time'] = $request->read_time;
        $guruData['author'] = $request->author;
        $guruData['active'] = true;

        // Handle banner desktop upload
if ($request->hasFile('banner_desktop')) {
    // PERBAIKAN: Hapus file lama dengan pengecekan yang aman
    if (!empty($guruData['banner_desktop'])) {
        $oldPath = is_array($guruData['banner_desktop']) ? 
                   $guruData['banner_desktop'][0] : 
                   $guruData['banner_desktop'];
        
        if (is_string($oldPath) && Storage::disk('public')->exists($oldPath)) {
            Storage::disk('public')->delete($oldPath);
        }
    }
    
    $bannerDesktop = $request->file('banner_desktop');
    $filename = time() . '_desktop_' . $bannerDesktop->getClientOriginalName();
    $bannerDesktopPath = $bannerDesktop->storeAs('guru-banners', $filename, 'public');
    $guruData['banner_desktop'] = $bannerDesktopPath;
}

// Handle banner mobile upload
if ($request->hasFile('banner_mobile')) {
    // PERBAIKAN: Hapus file lama dengan pengecekan yang aman
    if (!empty($guruData['banner_mobile'])) {
        $oldPath = is_array($guruData['banner_mobile']) ? 
                   $guruData['banner_mobile'][0] : 
                   $guruData['banner_mobile'];
        
        if (is_string($oldPath) && Storage::disk('public')->exists($oldPath)) {
            Storage::disk('public')->delete($oldPath);
        }
    }
    
    $bannerMobile = $request->file('banner_mobile');
    $filename = time() . '_mobile_' . $bannerMobile->getClientOriginalName();
    $bannerMobilePath = $bannerMobile->storeAs('guru-banners', $filename, 'public');
    $guruData['banner_mobile'] = $bannerMobilePath;
}


        // Handle banner mobile upload
        if ($request->hasFile('banner_mobile')) {
            // Hapus file lama jika ada
            if (!empty($guruData['banner_mobile']) && Storage::disk('public')->exists($guruData['banner_mobile'])) {
                Storage::disk('public')->delete($guruData['banner_mobile']);
            }
            
            $bannerMobile = $request->file('banner_mobile');
            $filename = time() . '_mobile_' . $bannerMobile->getClientOriginalName();
            $bannerMobilePath = $bannerMobile->storeAs('guru-banners', $filename, 'public');
            $guruData['banner_mobile'] = $bannerMobilePath;
        }

        $teacher->guruData = $guruData;
        $teacher->save(); // Gunakan save() untuk memastikan data tersimpan

        return response()->json([
            'success' => true,
            'message' => 'Teacher settings updated successfully',
            'data' => [
                'title' => $guruData['title'],
                'subtitle' => $guruData['subtitle'],
                'banner_desktop' => !empty($guruData['banner_desktop']) ? asset('storage/' . $guruData['banner_desktop']) : null,
                'banner_mobile' => !empty($guruData['banner_mobile']) ? asset('storage/' . $guruData['banner_mobile']) : null,
                'date' => $guruData['date'],
                'read_time' => $guruData['read_time'],
                'author' => $guruData['author'],
            ]
        ]);
    }
}

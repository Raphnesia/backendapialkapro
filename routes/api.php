<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EkstrakurikulerController;
use App\Http\Controllers\Api\FacilityController;
use App\Http\Controllers\Api\HomeSectionController;
use App\Http\Controllers\Api\IPMContentController;
use App\Http\Controllers\Api\IPMController;
use App\Http\Controllers\Api\PimpinanSMPController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ProfileSectionController;
use App\Http\Controllers\Api\SchoolActivityController;
use App\Http\Controllers\Api\SejarahSingkatController;
use App\Http\Controllers\Api\StrukturOrganisasiContentController;
use App\Http\Controllers\Api\StrukturOrganisasiController;
use App\Http\Controllers\Api\TeacherController;
use App\Http\Controllers\Api\TeacherSettingController;
use App\Http\Controllers\Api\VisiMisiController;
// Removed ProgramKhususController and related routes
use App\Http\Controllers\Api\ProgramKhususApiController;

use App\Http\Controllers\Api\HomeHeroVideoController;
use App\Http\Controllers\Api\SocialMediaController;
use App\Http\Controllers\Api\NavigationController;
use App\Http\Controllers\Api\InfoPPDBController;
use App\Http\Controllers\Api\ProfilController;
use App\Http\Controllers\Api\TapakSuciController;
use App\Http\Controllers\Api\HisbulWathanController;
use App\Http\Controllers\Api\PrestasiController;
use App\Http\Controllers\Api\AlkaproLibraryController;

Route::prefix('v1')->group(function () {
    // Info PPDB Settings
    Route::get('/info-ppdb/settings', [InfoPPDBController::class, 'settings']);
    Route::post('/info-ppdb/settings', [InfoPPDBController::class, 'updateSettings']);
    
    // Profil Settings
    Route::get('/profil/settings', [ProfilController::class, 'index']);
    Route::post('/profil/settings', [ProfilController::class, 'update']);
    // Home Sections
    Route::get('/home-sections', [HomeSectionController::class, 'index']);
    Route::get('/home-sections/type/{sectionType}', [HomeSectionController::class, 'byType']);
    Route::get('/home-sections/{id}', [HomeSectionController::class, 'show']);



    // Home Hero Videos
    Route::get('/home-hero-videos', [HomeHeroVideoController::class, 'index']);
    Route::get('/home-hero-videos/active', [HomeHeroVideoController::class, 'active']);
    Route::get('/home-hero-videos/{id}', [HomeHeroVideoController::class, 'show']);

    // Social Media Feed
    Route::get('/social-media/settings', [SocialMediaController::class, 'settings']);
    Route::get('/social-media/settings/raw', [SocialMediaController::class, 'settingsRaw']);
    Route::get('/social-media/instagram', [SocialMediaController::class, 'instagram']);

    // Teachers & Staff
    Route::get('/teachers', [TeacherController::class, 'index']);
    Route::get('/teachers/list', [TeacherController::class, 'teachers']);
    Route::get('/teachers/by-subject', [TeacherController::class, 'bySubject']);
    Route::get('/staff/list', [TeacherController::class, 'staff']);
    Route::get('/teacher-settings', [TeacherSettingController::class, 'index']);
    Route::post('/teacher-settings', [TeacherSettingController::class, 'update']);

    // Posts (News & Articles)
    Route::get('/posts', [PostController::class, 'index']);
    Route::get('/news', [PostController::class, 'news']);
    Route::get('/articles', [PostController::class, 'articles']);
    Route::get('/posts/{slug}', [PostController::class, 'show']);

    // Profile Sections
    Route::get('/profile-sections', [ProfileSectionController::class, 'index']);
    Route::get('/profile-sections/{slug}', [ProfileSectionController::class, 'show']);

    // Facilities
    Route::get('/facilities', [FacilityController::class, 'index']);
    Route::get('/facilities/settings', [FacilityController::class, 'settings']);
    Route::get('/facilities/boxes', [FacilityController::class, 'boxes']);
    Route::get('/facilities/{slug}', [FacilityController::class, 'show']);
    
    // Sub-Facilities (Dynamic)
    Route::get('/facilities/sub/{parentSlug}', [FacilityController::class, 'subFacility']);
    Route::get('/facilities/sub/{parentSlug}/category/{category}', [FacilityController::class, 'subFacilityByCategory']);
    Route::get('/facilities/sub/{parentSlug}/{slug}', [FacilityController::class, 'subFacilityShow']);

    // School Activities
    Route::get('/activities', [SchoolActivityController::class, 'index']);
    Route::get('/activities/settings', [SchoolActivityController::class, 'settings']);
    Route::get('/activities/complete', [SchoolActivityController::class, 'complete']);
    Route::get('/activities/{slug}', [SchoolActivityController::class, 'show']);

    // Pimpinan SMP
    Route::get('/pimpinan-smp', [PimpinanSMPController::class, 'index']);
    Route::get('/pimpinan-smp/complete', [PimpinanSMPController::class, 'complete']);
    Route::get('/pimpinan-smp/settings', [PimpinanSMPController::class, 'settings']);
    Route::get('/pimpinan-smp/boxes', [PimpinanSMPController::class, 'boxes']);
    Route::get('/pimpinan-smp/kepala-sekolah', [PimpinanSMPController::class, 'kepalaSekolah']);
    Route::get('/pimpinan-smp/wakil-kepala-sekolah', [PimpinanSMPController::class, 'wakilKepalaSekolah']);
    Route::get('/pimpinan-smp/type/{type}', [PimpinanSMPController::class, 'byType']);
    Route::get('/pimpinan-smp/{id}', [PimpinanSMPController::class, 'show']);

    // Sejarah Singkat
Route::get('/sejarah-singkat', [SejarahSingkatController::class, 'index']);
Route::get('/sejarah-singkat/complete', [SejarahSingkatController::class, 'complete']);
Route::get('/sejarah-singkat/settings', [SejarahSingkatController::class, 'settings']);
Route::get('/sejarah-singkat/grid/{gridType}', [SejarahSingkatController::class, 'byGridType']);
Route::get('/sejarah-singkat/with-list-items', [SejarahSingkatController::class, 'withListItems']);
Route::get('/sejarah-singkat/{id}', [SejarahSingkatController::class, 'show']);

// Visi Misi
Route::get('/visi-misi', [VisiMisiController::class, 'index']);
Route::get('/visi-misi/complete', [VisiMisiController::class, 'complete']);
Route::get('/visi-misi/settings', [VisiMisiController::class, 'settings']);
Route::get('/visi-misi/grid/{gridType}', [VisiMisiController::class, 'byGridType']);
Route::get('/visi-misi/with-list-items', [VisiMisiController::class, 'withListItems']);
Route::get('/visi-misi/{id}', [VisiMisiController::class, 'show']);

// Struktur Organisasi
Route::get('/struktur-organisasi', [StrukturOrganisasiController::class, 'index']);
Route::get('/struktur-organisasi/complete', [StrukturOrganisasiController::class, 'complete']);
Route::get('/struktur-organisasi/settings', [StrukturOrganisasiController::class, 'settings']);
Route::get('/struktur-organisasi/{id}', [StrukturOrganisasiController::class, 'show']);

// IPM
Route::get('/ipm', [IPMController::class, 'index']);
Route::get('/ipm/complete', [IPMController::class, 'complete']);
Route::get('/ipm/settings', [IPMController::class, 'settings']);
Route::get('/ipm/{id}', [IPMController::class, 'show']);

// IPM Content
Route::get('/ipm-content', [IPMContentController::class, 'index']);
Route::get('/ipm-content/complete', [IPMContentController::class, 'complete']);
Route::get('/ipm-content/settings', [IPMContentController::class, 'settings']);
Route::get('/ipm-content/grid/{gridType}', [IPMContentController::class, 'byGridType']);
Route::get('/ipm-content/with-list-items', [IPMContentController::class, 'withListItems']);
Route::get('/ipm-content/{id}', [IPMContentController::class, 'show']);

// Struktur Organisasi Content
Route::get('/struktur-organisasi-content', [StrukturOrganisasiContentController::class, 'index']);
Route::get('/struktur-organisasi-content/grid/{gridType}', [StrukturOrganisasiContentController::class, 'byGridType']);
Route::get('/struktur-organisasi-content/with-bidang-structure', [StrukturOrganisasiContentController::class, 'withBidangStructure']);
Route::get('/struktur-organisasi-content/display/{displayType}', [StrukturOrganisasiContentController::class, 'byDisplayType']);
Route::get('/struktur-organisasi-content/{id}', [StrukturOrganisasiContentController::class, 'show']);

// Ekstrakurikuler
Route::get('/ekstrakurikuler', [EkstrakurikulerController::class, 'index']);
Route::get('/ekstrakurikuler/complete', [EkstrakurikulerController::class, 'complete']);
Route::get('/ekstrakurikuler/settings', [EkstrakurikulerController::class, 'settings']);
Route::get('/ekstrakurikuler/category/{category}', [EkstrakurikulerController::class, 'byCategory']);
Route::get('/ekstrakurikuler/{id}', [EkstrakurikulerController::class, 'show']);

    // Program Khusus (new)
    Route::get('/program-khusus', [ProgramKhususApiController::class, 'index']);
    Route::get('/program-khusus/{slug}', [ProgramKhususApiController::class, 'type']);

    // Program Khusus admin API (non-auth; tambahkan middleware auth jika perlu)
    Route::get('/program-khusus-types', [ProgramKhususApiController::class, 'listTypes']);

    // Page CRUD
    Route::post('/program-khusus/page', [ProgramKhususApiController::class, 'createPage']);
    Route::put('/program-khusus/page/{id}', [ProgramKhususApiController::class, 'updatePage']);
    Route::delete('/program-khusus/page/{id}', [ProgramKhususApiController::class, 'deletePage']);

    // Type CRUD
    Route::post('/program-khusus/type', [ProgramKhususApiController::class, 'createType']);
    Route::put('/program-khusus/type/{slug}', [ProgramKhususApiController::class, 'updateType']);
    Route::delete('/program-khusus/type/{slug}', [ProgramKhususApiController::class, 'deleteType']);

    // Navigation & Branding
    Route::get('/navigation/header', [NavigationController::class, 'header']);
    Route::get('/navigation/footer', [NavigationController::class, 'footer']);

    // Tapak Suci
    Route::get('/tapak-suci', [TapakSuciController::class, 'index']);
    Route::get('/tapak-suci/complete', [TapakSuciController::class, 'complete']);
    Route::get('/tapak-suci/settings', [TapakSuciController::class, 'settings']);
    Route::get('/tapak-suci/{id}', [TapakSuciController::class, 'show']);

    // Hisbul Wathan
    Route::get('/hisbul-wathan', [HisbulWathanController::class, 'index']);
    Route::get('/hisbul-wathan/complete', [HisbulWathanController::class, 'complete']);
    Route::get('/hisbul-wathan/settings', [HisbulWathanController::class, 'settings']);
    Route::get('/hisbul-wathan/{id}', [HisbulWathanController::class, 'show']);

    // Prestasi
    Route::get('/prestasi/settings', [PrestasiController::class, 'settings']);
    Route::get('/prestasi/right-image', [PrestasiController::class, 'rightImage']);
    Route::get('/prestasi/list', [PrestasiController::class, 'listPrestasi']);
    Route::get('/prestasi/tahfidz', [PrestasiController::class, 'listTahfidz']);
    Route::get('/prestasi/complete', [PrestasiController::class, 'complete']);

    // Alkapro Library
    Route::get('/alkapro-library/settings', [AlkaproLibraryController::class, 'getSettings']);
    Route::get('/alkapro-library/complete', [AlkaproLibraryController::class, 'getComplete']);
    Route::get('/alkapro-library/gallery', [AlkaproLibraryController::class, 'getGallery']);
    Route::get('/alkapro-library/pamphlets', [AlkaproLibraryController::class, 'getPamphlets']);

    // Health check
    Route::get('/health', function () {
        return response()->json([
            'status' => 'ok',
            'message' => 'API is running',
            'timestamp' => now()->toISOString(),
        ]);
    });
});
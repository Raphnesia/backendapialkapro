# Setup GuruData - Teacher Management System

## Backend Configuration Complete ✅

### Fitur yang Sudah Dikonfigurasi:
1. **guruData di TeacherResource** - untuk mengelola banner, judul, subtitle dll
2. **Single Resource Interface** di dashboard Filament
3. **API Endpoint** untuk frontend

## Cara Menggunakan di Dashboard Filament:

### 1. Akses Guru & Staff
- Masuk ke dashboard Filament
- Klik menu **"Guru & Staff"** (icon users)

### 2. Pengaturan guruData
- Klik **"Guru & Staff"** untuk melihat daftar
- Pilih salah satu guru/staff untuk mengatur guruData
- Scroll ke bagian **"Pengaturan Halaman Guru (guruData)"**
- Isi form dengan data:
  - **Judul**: Tim Guru Profesional SMP Muhammadiyah Al Kautsar PK Kartasura
  - **Subtitle**: Tenaga pengajar berkualitas dengan dedikasi tinggi...
  - **Banner Desktop**: Upload gambar (1920x400px)
  - **Banner Mobile**: Upload gambar (768x300px)
  - **Tanggal**: 17 Juli 2025
  - **Estimasi Waktu Baca**: 5 Menit untuk membaca
  - **Penulis**: Tim Humas SMP
  - **Aktifkan Settings**: Set ke true (hanya satu yang boleh aktif)

## API Endpoint untuk Frontend:

```bash
GET /api/teacher-settings
```

Response:
```json
{
  "title": "Tim Guru Profesional SMP Muhammadiyah Al Kautsar PK Kartasura",
  "subtitle": "Tenaga pengajar berkualitas dengan dedikasi tinggi...",
  "banner_desktop": "/guru/Adam-Muttaqien-M.Si_.jpg",
  "banner_mobile": "/guru/Cindy-Trisnawati-S.Pd-M.Pd_.jpg",
  "date": "17 Juli 2025",
  "read_time": "5 Menit untuk membaca",
  "author": "Tim Humas SMP"
}
```

## Setup Database:
```bash
# Jalankan migrasi
php artisan migrate

# Data default akan otomatis terisi
```

## Struktur File yang Diupdate:
- `app/Models/Teacher.php` - Ditambahkan field guruData (JSON)
- `app/Filament/Resources/TeacherResource.php` - Ditambahkan section guruData
- `app/Http/Controllers/Api/TeacherSettingController.php` - Updated untuk mengambil dari Teacher model
- `database/migrations/...` - Migration untuk menambahkan guruData ke tabel teachers

## File yang Dihapus:
- `app/Models/TeacherSetting.php` - Tidak digunakan lagi
- `app/Filament/Resources/TeacherSettingResource.php` - Terintegrasi ke TeacherResource
- `app/Filament/Pages/TeacherManagement.php` - Tidak diperlukan lagi
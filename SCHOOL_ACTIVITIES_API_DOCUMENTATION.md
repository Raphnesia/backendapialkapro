# School Activities API Documentation

## Overview
API untuk mengelola data kegiatan sekolah yang mendukung frontend React/Next.js dengan card yang lebih tinggi untuk menampilkan foto kegiatan.

Mulai update ini, field `description` mendukung Rich Text (list, heading, bold/italic) serta upload gambar tersemat.

## Base URL
```
http://localhost:8000/api/v1
```

## Endpoints

### 1. Get All School Activities
**GET** `/activities`

#### Response Format
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "title": "Prestasi Gemilang Siswa dalam Olimpiade Matematika Nasional",
      "slug": "prestasi-gemilang-siswa-dalam-olimpiade-matematika-nasional",
      "description": "<p>Prestasi membanggakan...</p>",
      "excerpt": "Siswa SMP Muhammadiyah Al Kautsar PK Kartasura meraih juara 2...",
      "image": "http://localhost:8000/storage/activities/prestasi-matematika.jpg",
      "activity_date": "2024-01-10",
      "activity_time": "09:00",
      "date": "15 January 2024",
      "location": "Jakarta Convention Center",
      "category": "Prestasi Akademik",
      "participants": ["Ahmad Rizki", "Siti Nurhaliza"],
      "author": "Tim Redaksi",
      "type": "prestasi",
      "order_index": 1
    }
  ]
}
```

### 2. Get Single School Activity
**GET** `/activities/{slug}`

#### Parameters
- `slug` (string, required): URL slug of the activity

#### Response Format
```json
{
  "success": true,
  "data": {
    "id": 1,
    "title": "Prestasi Gemilang Siswa dalam Olimpiade Matematika Nasional",
    "slug": "prestasi-gemilang-siswa-dalam-olimpiade-matematika-nasional",
    "description": "<p>Prestasi membanggakan...</p>",
    "excerpt": "Siswa SMP Muhammadiyah Al Kautsar PK Kartasura meraih juara 2...",
    "image": "http://localhost:8000/storage/activities/prestasi-matematika.jpg",
    "activity_date": "2024-01-10",
    "activity_time": "09:00",
    "date": "15 January 2024",
    "location": "Jakarta Convention Center",
    "category": "Prestasi Akademik",
    "participants": ["Ahmad Rizki", "Siti Nurhaliza"],
    "author": "Tim Redaksi",
    "type": "prestasi",
    "order_index": 1
  }
}
```

### 3. Get School Activities Settings
**GET** `/activities/settings`

Mengambil pengaturan halaman Kegiatan: title, subtitle, banner desktop, banner mobile.

#### Response Format
```json
{
  "success": true,
  "data": {
    "id": 1,
    "title": "Kegiatan Sekolah",
    "subtitle": "Dokumentasi kegiatan, prestasi, dan aktivitas siswa",
    "banner_desktop": "http://localhost:8000/storage/activities/banner-desktop.jpg",
    "banner_mobile": "http://localhost:8000/storage/activities/banner-mobile.jpg"
  }
}
```

### 4. Get Complete Activities Data
**GET** `/activities/complete`

Mengambil data lengkap: settings + daftar kegiatan (array yang sama dengan endpoint `/activities`).

#### Response Format
```json
{
  "success": true,
  "data": {
    "settings": {
      "id": 1,
      "title": "Kegiatan Sekolah",
      "subtitle": "Dokumentasi kegiatan, prestasi, dan aktivitas siswa",
      "banner_desktop": "http://localhost:8000/storage/activities/banner-desktop.jpg",
      "banner_mobile": "http://localhost:8000/storage/activities/banner-mobile.jpg"
    },
    "activities": [
      {
        "id": 1,
        "title": "Prestasi Gemilang...",
        "slug": "prestasi-gemilang...",
        "description": "<p>Prestasi membanggakan...</p>",
        "excerpt": "Ringkasan...",
        "image": "http://localhost:8000/storage/activities/prestasi-matematika.jpg",
        "activity_date": "2024-01-10",
        "activity_time": "09:00",
        "date": "15 January 2024",
        "location": "Jakarta Convention Center",
        "category": "Prestasi Akademik",
        "participants": ["Ahmad Rizki", "Siti Nurhaliza"],
        "author": "Tim Redaksi",
        "type": "prestasi",
        "order_index": 1
      }
    ]
  }
}
```

## Field Descriptions

| Field | Type | Description |
|-------|------|-------------|
| `id` | integer | Unique identifier |
| `title` | string | Judul kegiatan |
| `slug` | string | URL-friendly version of title |
| `description` | text (HTML) | Deskripsi lengkap; mendukung Rich Text dan gambar |
| `excerpt` | string | Ringkasan singkat untuk card |
| `image` | string | URL gambar kegiatan (full URL with domain) |
| `activity_date` | date | Tanggal pelaksanaan kegiatan (YYYY-MM-DD) |
| `activity_time` | time | Waktu pelaksanaan kegiatan (HH:MM) |
| `date` | string | Tanggal publikasi (formatted: "DD Month YYYY") |
| `location` | string | Lokasi kegiatan |
| `category` | string | Kategori kegiatan |
| `participants` | array | Daftar peserta kegiatan |
| `author` | string | Penulis/pelapor kegiatan |
| `type` | enum | `prestasi`, `ekstrakurikuler`, `akademik`, `sosial` |
| `order_index` | integer | Urutan tampilan |

## Frontend Integration Notes

- Gunakan endpoint `/activities/settings` untuk menampilkan title/subtitle dan memilih banner berdasarkan perangkat (desktop/mobile).
- Field `description` berformat HTML; render secara aman di frontend.
- Pastikan sudah menjalankan `php artisan storage:link` agar URL banner/gambar berfungsi.

## Categories Available
- **Prestasi Akademik**: Pencapaian akademik siswa
- **Ekstrakurikuler**: Kegiatan ekstrakurikuler
- **Kegiatan Sosial**: Kegiatan sosial dan bakti sosial
- **Kompetisi**: Kompetisi dan perlombaan

## Types Available
- **prestasi**: Prestasi dan penghargaan
- **ekstrakurikuler**: Kegiatan ekstrakurikuler
- **akademik**: Kegiatan akademik
- **sosial**: Kegiatan sosial

## Error Responses

### 404 Not Found
```json
{
  "success": false,
  "message": "Activity not found"
}
```

### 500 Internal Server Error
```json
{
  "success": false,
  "message": "Internal server error"
}
```

## Admin Panel
Data kegiatan sekolah dapat dikelola melalui admin panel Filament di:
```
http://localhost:8000/admin/school-activities
```

### Admin Features
- Create, Read, Update, Delete kegiatan
- Upload gambar kegiatan
- Set kategori dan tipe kegiatan
- Atur urutan tampilan
- Set status aktif/non-aktif
- Kelola peserta kegiatan

## Database Structure
Tabel: `school_activities`

```sql
CREATE TABLE school_activities (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    description TEXT,
    excerpt TEXT,
    image VARCHAR(255),
    activity_date DATE,
    activity_time TIME,
    date DATE,
    location VARCHAR(255),
    category VARCHAR(255),
    participants JSON,
    author VARCHAR(255) DEFAULT 'Admin',
    type ENUM('prestasi', 'ekstrakurikuler', 'akademik', 'sosial') DEFAULT 'akademik',
    is_active BOOLEAN DEFAULT TRUE,
    order_index INTEGER DEFAULT 0,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```
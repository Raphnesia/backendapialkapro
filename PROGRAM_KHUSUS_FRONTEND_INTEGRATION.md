# Dokumentasi Integrasi Frontend - Program Khusus

## Overview
Dashboard Filament sudah diperbaiki dan lebih mudah digunakan. Sekarang ada 2 resource dengan fitur **upload gambar langsung**:

1. **Halaman Utama Program Khusus** - untuk mengatur `/program-khusus`
2. **Detail Program (ICT/Tahfidz)** - untuk mengatur `/program-khusus/ict` dan `/program-khusus/tahfidz`

## 🆕 Fitur Upload Gambar

### ✅ Yang Sudah Diperbaiki
- **Upload Gambar Langsung:** Bukan lagi input path, tapi upload file langsung
- **Image Editor:** Bisa crop, resize, dan edit gambar di dashboard
- **Preview Gambar:** Bisa lihat gambar yang sudah diupload di tabel
- **Auto Path:** Path gambar otomatis dibuat setelah upload

### 📁 Struktur Upload
Semua gambar akan disimpan di:
```
public/storage/program-khusus/
```

### 🖼️ Field yang Bisa Upload Gambar

#### Halaman Utama Program Khusus:
- `hero_image_desktop` - Gambar Hero Desktop
- `hero_image_mobile` - Gambar Hero Mobile  
- `programs[].image` - Gambar Program Cards

#### Detail Program (ICT/Tahfidz):
- `banner_desktop` - Banner Desktop
- `banner_mobile` - Banner Mobile
- `featured_image` - Gambar Featured
- `features_image` - Gambar Features Section
- `benefits_items[].image` - Gambar Benefits Items
- `gallery_items[].src` - Gambar Gallery
- `cta_background` - Background CTA

## Struktur Dashboard Baru

### 1. Halaman Utama Program Khusus
**Sections yang dapat diatur:**
- Hero Section (judul, subtitle, upload gambar desktop/mobile)
- Overview Section (judul dan subtitle)
- Program Cards (daftar program dengan upload gambar)
- Reasons Section (alasan memilih dengan icon)
- CTA Section (call to action dengan tombol)

### 2. Detail Program (ICT/Tahfidz)
**Sections yang dapat diatur:**
- Informasi Dasar (slug, judul, subtitle, upload banner)
- Introduction Section (badge, judul, subtitle)
- Featured Image Section (upload gambar dengan overlay)
- Key Points Section (poin-poin penting)
- Features Grid Section (upload gambar + grid fitur)
- Benefits Section (upload gambar dengan layout)
- Gallery Section (upload multiple gambar)
- CTA Section (upload background + call to action)

## API Endpoints

### 1. Halaman Utama
```javascript
// GET /api/v1/program-khusus
const response = await fetch('/api/v1/program-khusus');
const data = response.json();
```

### 2. Detail Program
```javascript
// GET /api/v1/program-khusus/ict
// GET /api/v1/program-khusus/tahfidz
const response = await fetch('/api/v1/program-khusus/ict');
const data = response.json();
```

## Cara Menggunakan

### 1. Buka Dashboard Filament
- Akses `/admin`
- Masuk ke menu "Program Khusus"
- Pilih resource yang ingin diatur

### 2. Upload Gambar
- **Klik field gambar** yang ingin diupload
- **Drag & drop** atau klik untuk pilih file
- **Edit gambar** jika diperlukan (crop, resize)
- **Simpan** perubahan

### 3. Isi Data Lainnya
- Semua field sudah ada default value
- Isi semua section yang diperlukan
- Gambar akan otomatis tersimpan di `storage/app/public/program-khusus/`

### 4. Frontend Integration
- Path gambar akan otomatis: `/storage/program-khusus/filename.jpg`
- Ganti data hardcode dengan data dari API
- Implementasikan loading state

## Contoh Response API dengan Upload Gambar

### Halaman Utama
```json
{
  "success": true,
  "data": {
    "page": {
      "hero_title": "Program Khusus",
      "hero_subtitle": "Program unggulan SMP Muhammadiyah...",
      "hero_image_desktop": "/storage/program-khusus/hero-desktop.jpg",
      "hero_image_mobile": "/storage/program-khusus/hero-mobile.jpg",
      "overview_title": "Program Unggulan Kami",
      "overview_subtitle": "Kami menawarkan dua program khusus...",
      "programs": [
        {
          "id": "tahfidz",
          "title": "Program Tahfidz Al-Quran",
          "subtitle": "Membentuk generasi Qurani...",
          "description": "Program Tahfidz Al-Quran di sekolah kami...",
          "image": "/storage/program-khusus/tahfidz-program.jpg",
          "color": "green",
          "href": "/program-khusus/tahfidz",
          "features": [
            "Metode pembelajaran terbukti efektif",
            "Ustadz dan ustadzah berpengalaman",
            "Fasilitas ruang tahfidz yang nyaman",
            "Lingkungan Islami yang mendukung"
          ]
        },
        {
          "id": "ict",
          "title": "Program ICT",
          "subtitle": "Mempersiapkan siswa menghadapi era digital...",
          "description": "Program ICT dirancang untuk memberikan...",
          "image": "/storage/program-khusus/ict-program.jpg",
          "color": "blue",
          "href": "/program-khusus/ict",
          "features": [
            "Kurikulum ICT terkini",
            "Laboratorium komputer modern",
            "Pembelajaran praktis dan project-based",
            "Sertifikasi internasional"
          ]
        }
      ],
      "reasons_title": "Mengapa Memilih Program Khusus Kami?",
      "reasons_subtitle": "Program khusus kami dirancang dengan pendekatan holistik...",
      "reasons": [
        {
          "icon": "🎯",
          "title": "Fokus Spesifik",
          "description": "Setiap program dirancang dengan kurikulum yang fokus..."
        },
        {
          "icon": "👨‍🏫",
          "title": "Pengajar Ahli",
          "description": "Dibimbing oleh pengajar yang berpengalaman..."
        },
        {
          "icon": "🏆",
          "title": "Prestasi Terbukti",
          "description": "Program kami telah menghasilkan siswa-siswa berprestasi..."
        }
      ],
      "cta_title": "Siap Bergabung dengan Program Khusus Kami?",
      "cta_subtitle": "Pilih program yang sesuai dengan minat dan bakat Anda...",
      "cta_primary_label": "Program Tahfidz",
      "cta_primary_url": "/program-khusus/tahfidz",
      "cta_secondary_label": "Program ICT",
      "cta_secondary_url": "/program-khusus/ict",
      "is_active": true
    },
    "types": {
      "ict": { /* detail program ICT */ },
      "tahfidz": { /* detail program Tahfidz */ }
    }
  }
}
```

### Detail Program
```json
{
  "success": true,
  "data": {
    "slug": "ict",
    "title": "Program ICT",
    "subtitle": "Program unggulan yang memadukan pendidikan akademik dengan teknologi informasi dan komunikasi",
    "banner_desktop": "/storage/program-khusus/ict-banner-desktop.jpg",
    "banner_mobile": "/storage/program-khusus/ict-banner-mobile.jpg",
    "intro_badge": "Pendidikan Digital",
    "intro_title": "Menggabungkan Akademik & Digital",
    "intro_subtitle": "Program ICT di SMP Muhammadiyah Al Kautsar PK Kartasura dirancang khusus...",
    "featured_image": "/storage/program-khusus/ict-featured.jpg",
    "featured_overlay_title": "Suasana Pembelajaran",
    "featured_overlay_desc": "Lingkungan yang kondusif untuk belajar teknologi dengan fasilitas modern",
    "featured_badge": "Program Unggulan",
    "key_points": [
      {
        "icon": "🖥️",
        "title": "Teknologi Terkini",
        "description": "Menggunakan perangkat dan software terbaru untuk pembelajaran ICT yang optimal..."
      },
      {
        "icon": "👥",
        "title": "Instruktur Ahli",
        "description": "Dibimbing oleh instruktur berpengalaman di bidang teknologi informasi..."
      }
    ],
    "features_title": "Mengapa Memilih Program Kami",
    "features_subtitle": "Alasan kuat untuk memilih program ICT kami yang telah terbukti menghasilkan lulusan berkualitas",
    "features_image": "/storage/program-khusus/ict-features.jpg",
    "features_items": [
      {
        "icon": "📚",
        "title": "Metode Pembelajaran",
        "description": "Menggunakan metode project-based learning dan hands-on training..."
      },
      {
        "icon": "👥",
        "title": "Bimbingan Personal",
        "description": "Setiap siswa dibimbing secara individual oleh instruktur berpengalaman..."
      }
    ],
    "benefits_badge": "Tiga Kompetensi Utama",
    "benefits_title": "Dampak Positif Program ICT",
    "benefits_subtitle": "Program ICT memberikan dampak positif komprehensif melalui tiga kompetensi utama",
    "benefits_items": [
      {
        "badge_label": "Kompetensi 1",
        "title": "Programming & Development",
        "description": "Pembelajaran programming yang komprehensif meliputi Web Development...",
        "image": "/storage/program-khusus/ict-benefit-1.jpg",
        "layout": "imageLeft"
      },
      {
        "badge_label": "Kompetensi 2",
        "title": "Digital Design",
        "description": "Kurikulum design grafis yang terukur dan sistematis...",
        "image": "/storage/program-khusus/ict-benefit-2.jpg",
        "layout": "imageRight"
      }
    ],
    "gallery_title": "Galeri Pembelajaran",
    "gallery_subtitle": "Suasana pembelajaran yang kondusif dan inspiratif dengan fasilitas modern",
    "gallery_items": [
      {
        "src": "/storage/program-khusus/ict-gallery-1.jpg",
        "title": "Lab Programming",
        "desc": "Laboratorium komputer dengan perangkat modern",
        "color_gradient": "from-blue-500 to-cyan-500"
      },
      {
        "src": "/storage/program-khusus/ict-gallery-2.jpg",
        "title": "Design Studio",
        "desc": "Studio design dengan software terkini",
        "color_gradient": "from-purple-500 to-indigo-500"
      }
    ],
    "cta_background": "/storage/program-khusus/ict-cta-bg.jpg",
    "cta_badge": "Bergabung Sekarang",
    "cta_title": "Siap Menjadi Bagian dari Generasi Digital?",
    "cta_description": "Bergabunglah dengan Program ICT SMP Muhammadiyah Al Kautsar PK Kartasura...",
    "cta_primary_label": "Lihat Program Lainnya",
    "cta_primary_url": "/program-khusus",
    "cta_secondary_label": "Tentang Sekolah",
    "cta_secondary_url": "/profil",
    "is_active": true
  }
}
```

## Langkah Implementasi

1. **Buka Dashboard Filament** di `/admin`
2. **Upload Gambar** di menu "Program Khusus"
3. **Isi Data Lainnya** sesuai kebutuhan
4. **Ganti Data Hardcode** di frontend dengan data dari API
5. **Test Semua Fitur** yang sudah diatur

## Tips Upload Gambar

1. **Format yang Didukung:** JPG, PNG, GIF, WebP
2. **Ukuran Maksimal:** 10MB per file
3. **Resolusi Optimal:** 
   - Hero/Banner: 1920x1080px
   - Program Cards: 800x600px
   - Gallery: 1200x800px
4. **Nama File:** Otomatis dibuat unik
5. **Storage:** Semua file tersimpan di `storage/app/public/program-khusus/`

Dashboard sekarang sudah bisa upload gambar langsung dan lebih mudah digunakan! 🎉

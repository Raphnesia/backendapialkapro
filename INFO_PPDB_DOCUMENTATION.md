# Dokumentasi Info PPDB Dashboard

## Overview
Dashboard untuk mengatur konten halaman Info PPDB yang terintegrasi dengan Filament Admin Panel. Sistem ini menggunakan struktur Resource yang sama dengan Program Khusus Type yang sudah berfungsi dengan baik.

## Fitur Utama

### 1. Banner Settings
- **Desktop Banner**: Gambar banner untuk tampilan desktop
- **Mobile Banner**: Gambar banner untuk tampilan mobile  
- **Title**: Judul utama halaman
- **Subtitle**: Subtitle deskriptif

### 2. Introduction Section
- **Badge**: Label kategori (default: "Penerimaan Peserta Didik Baru")
- **Title**: Judul pengenalan
- **Subtitle**: Deskripsi lengkap
- **Featured Image**: Gambar utama dengan overlay
- **Overlay Title & Description**: Teks yang muncul di atas gambar

### 3. Key Points
- **Repeater**: Daftar poin-poin penting
- **Icon**: Icon Heroicon (opsional)
- **Title**: Judul poin
- **Description**: Penjelasan detail

### 4. Alur Pendaftaran
- **Section Title & Subtitle**: Header alur pendaftaran
- **Alur Image**: Gambar ilustrasi alur
- **Steps**: Langkah-langkah pendaftaran (repeater)
  - Icon, Title, Description untuk setiap step

### 5. Program Options
- **Section Badge, Title, Subtitle**: Header program section
- **Program Rows**: Daftar program (repeater)
  - Reverse Layout toggle (gambar kiri/kanan)
  - Badge, Title, Description
  - Image program

### 6. Call to Action (CTA)
- **Background**: Gambar background CTA
- **Badge, Title, Description**: Konten CTA
- **Primary & Secondary Buttons**: Tombol aksi dengan label dan URL

### 7. Additional Settings
- **Registration Deadline**: Deadline pendaftaran
- **Academic Year**: Tahun ajaran
- **Registration Status**: Toggle buka/tutup pendaftaran
- **Contact Info**: Informasi kontak
- **SEO**: Meta description dan keywords

## Spesifikasi Gambar

### 1. Banner Images
- **Desktop Banner**: 1920x1080px (16:9), JPEG/PNG, Max 100MB
- **Mobile Banner**: 1080x1920px (9:16), JPEG/PNG, Max 100MB
- **Format**: JPEG/PNG untuk fleksibilitas
- **Mode**: Cover (crop dan resize otomatis)

### 2. Featured & Content Images
- **Featured Image**: 1200x675px (16:9), JPEG/PNG, Max 100MB
- **Alur Image**: 1200x675px (16:9), JPEG/PNG, Max 100MB
- **CTA Background**: 1200x675px (16:9), JPEG/PNG, Max 100MB

### 3. Program Images
- **Program Images**: 800x600px (4:3), JPEG/PNG, Max 100MB
- **Aspect Ratio**: 4:3 untuk tampilan program yang proporsional

### 4. Keunggulan Konfigurasi
- **Max 100MB**: Mendukung file asli berukuran besar
- **Auto-resize**: Otomatis resize ke ukuran optimal
- **Format Fleksibel**: JPEG/PNG sesuai kebutuhan
- **Helper Text**: Panduan ukuran yang direkomendasikan
- **Image Processing**: Menggunakan Intervention Image dengan konfigurasi optimal

## Struktur File

```
app/
├── Filament/
│   └── Resources/
│       └── InfoPPDBSettingsResource.php          # Resource utama
│           └── Pages/
│               ├── ListInfoPPDBSettings.php      # Halaman list
│               ├── CreateInfoPPDBSettings.php    # Halaman create
│               └── EditInfoPPDBSettings.php      # Halaman edit
├── Models/
│   └── InfoPPDBSettings.php                      # Model database
├── Http/
│   └── Controllers/
│       └── Api/
│           └── InfoPPDBController.php            # API controller
└── config/
    └── image.php                                 # Konfigurasi image processing
```

## Cara Akses Dashboard

### 1. Login ke Filament Admin
```
URL: http://your-domain.com/admin
Username: [admin_username]
Password: [admin_password]
```

### 2. Navigasi Menu
- Buka sidebar kiri
- Cari grup "PPDB Management"
- Klik "Info PPDB Settings"

### 3. Halaman yang Tersedia
- **List**: Melihat semua settings (hanya 1 record)
- **Create**: Membuat settings baru (hanya bisa 1x)
- **Edit**: Mengubah settings yang ada

## Upload Gambar

### 1. FileUpload Component
- Semua field gambar menggunakan `FileUpload` component yang dioptimasi
- Disk: `public`
- Directory: `ppdb/[folder]`
- Visibility: `public`
- **Max Size**: 100MB (mendukung file besar)
- **Auto-resize**: Ke ukuran optimal dengan aspect ratio yang tepat

### 2. Struktur Folder
```
storage/app/public/ppdb/
├── banners/          # Banner desktop & mobile (HD Quality)
├── featured/         # Featured image (1200x675px)
├── alur/            # Alur pendaftaran image (1200x675px)
├── programs/         # Program images (800x600px)
└── cta/             # CTA background (1200x675px)
```

### 3. Cara Upload
1. Klik area upload atau drag & drop file
2. Pilih file gambar (JPEG, PNG, JPG, GIF, WEBP)
3. **File otomatis di-resize** ke ukuran optimal
4. Path file otomatis tersimpan ke database
5. **Gambar siap pakai di frontend** dengan kualitas tinggi

### 4. Tips Upload Gambar Berkualitas
- **Gunakan file asli berukuran besar** (1-10MB) untuk hasil terbaik
- **Format JPEG/PNG** untuk fleksibilitas
- **Aspect ratio sesuai** dengan yang direkomendasikan
- **Max 100MB** memastikan tidak ada batasan ukuran file

## Konfigurasi Image Processing

### 1. File config/image.php
```php
'quality' => [
    'jpeg' => 90,    // JPEG quality tinggi
    'png' => 9,      // PNG compression optimal
    'webp' => 90,    // WebP quality tinggi
],

'defaults' => [
    'max_width' => 1920,   // Max width default
    'max_height' => 1080,  // Max height default
    'format' => 'jpeg',    // Format default
    'quality' => 90,       // Quality default
],
```

### 2. Environment Variables
```env
# Image processing
IMAGE_DRIVER=gd                    # GD Library atau Imagick
IMAGE_CACHE_ENABLED=true          # Enable image cache
IMAGE_CACHE_TTL=86400            # Cache TTL dalam detik
```

## API Endpoints

### 1. GET Info PPDB Settings
```
GET /api/v1/info-ppdb/settings
```

**Response:**
```json
{
    "success": true,
    "data": {
        "title": "Info PPDB",
        "subtitle": "Alur Pendaftaran SMP Muhammadiyah Al Kautsar PK Kartasura",
        "banner_desktop": "ppdb/banners/filename.jpg",
        "banner_mobile": "ppdb/banners/filename.jpg",
        "intro_badge": "Penerimaan Peserta Didik Baru",
        "intro_title": "Mari Daftarkan Putra Putri Anda...",
        "intro_subtitle": "Informasi lengkap mengenai alur...",
        "featured_image": "ppdb/featured/filename.jpg",
        "featured_overlay_title": "Digital School",
        "featured_overlay_desc": "Sekolahku Surgaku",
        "key_points": [
            {
                "icon": "heroicon-o-star",
                "title": "Judul Poin",
                "description": "Deskripsi poin"
            }
        ],
        "alur_title": "Pendaftaran Online",
        "alur_subtitle": "Langkah-langkah mudah...",
        "alur_image": "ppdb/alur/filename.jpg",
        "steps": [
            {
                "icon": "heroicon-o-arrow-right",
                "title": "Judul Step",
                "description": "Deskripsi step"
            }
        ],
        "program_section_badge": "Program Khusus",
        "program_section_title": "Pilihan Program Khusus Tersedia",
        "program_section_subtitle": "Berbagai program unggulan...",
        "program_rows": [
            {
                "reverse": false,
                "badge": "Kelas Tahfidz",
                "title": "Program Khusus Kelas Tahfidz",
                "description": "Program ini memfasilitasi...",
                "image": "ppdb/programs/filename.jpg"
            }
        ],
        "cta_background": "ppdb/cta/filename.jpg",
        "cta_badge": "PPDB INDEN 2025 / 2026",
        "cta_title": "Siap Menjadi Bagian dari...",
        "cta_description": "Siap Menjadi Bagian dari...",
        "cta_primary_label": "PPDB Inden 2025 / 2026",
        "cta_primary_url": "#",
        "cta_secondary_label": "Tentang ALKAPRO",
        "cta_secondary_url": "#",
        "registration_deadline": "2025-12-31",
        "academic_year": "2025 / 2026",
        "is_registration_open": true,
        "contact_info": "Email: ppdb@smpsite.com\nWhatsApp: +62 812-3456-7890",
        "meta_description": "Deskripsi untuk SEO",
        "meta_keywords": "ppdb, smp, muhammadiyah, kartasura"
    }
}
```

### 2. POST Update Info PPDB Settings
```
POST /api/v1/info-ppdb/settings
Content-Type: application/json
```

**Request Body:** (sama seperti response GET di atas)

## Integrasi Frontend

### 1. Fetch Data
```javascript
// Next.js
const fetchInfoPPDB = async () => {
    try {
        const response = await fetch('/api/v1/info-ppdb/settings');
        const data = await response.json();
        
        if (data.success) {
            return data.data;
        }
    } catch (error) {
        console.error('Error fetching Info PPDB:', error);
    }
};
```

### 2. Display Images (Kualitas Tinggi)
```javascript
// Gunakan path dari API dengan storage
const imageUrl = `https://your-domain.com/storage/${data.banner_desktop}`;

// Atau dengan Next.js Image (Recommended)
import Image from 'next/image';

<Image 
    src={`/storage/${data.banner_desktop}`}
    alt="Banner Desktop"
    width={1920}
    height={1080}
    quality={90}
    priority={true} // Untuk banner utama
/>
```

### 3. Render Repeater Data
```javascript
// Key Points
{data.key_points?.map((point, index) => (
    <div key={index} className="key-point">
        <i className={point.icon}></i>
        <h3>{point.title}</h3>
        <p>{point.description}</p>
    </div>
))}

// Program Rows
{data.program_rows?.map((program, index) => (
    <div key={index} className={`program-row ${program.reverse ? 'reverse' : ''}`}>
        <div className="content">
            <span className="badge">{program.badge}</span>
            <h3>{program.title}</h3>
            <p>{program.description}</p>
        </div>
        <div className="image">
            <Image 
                src={`/storage/${program.image}`}
                alt={program.title}
                width={800}
                height={600}
                quality={90}
            />
        </div>
    </div>
))}
```

## Troubleshooting

### 1. Gambar Tidak Muncul
- Pastikan `storage:link` sudah dijalankan
- Cek permission folder `storage/app/public`
- Pastikan path di database benar
- **Gambar sekarang berkualitas tinggi** (tidak lagi 6KB)

### 2. Error Upload
- Cek disk storage di `config/filesystems.php`
- Pastikan folder `ppdb/` ada dan writable
- **Max size sekarang 100MB** (bisa upload file besar)
- **Format JPEG/PNG** didukung penuh

### 3. API Error
- Cek route di `routes/api.php`
- Pastikan controller ada dan benar
- Cek CORS settings jika frontend berbeda domain

### 4. Image Processing Error
- Pastikan extension GD atau Imagick terinstall
- Cek konfigurasi di `config/image.php`
- Clear cache: `php artisan config:clear`

## Deployment

### 1. Production Setup
```bash
# Set environment
APP_ENV=production
APP_DEBUG=false

# Clear cache
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Storage link
php artisan storage:link

# Set permissions
chmod -R 775 storage/
chmod -R 775 public/storage/
```

### 2. Database Migration
```bash
php artisan migrate
```

### 3. File Permissions
```bash
# Linux/Unix
chown -R www-data:www-data storage/
chown -R www-data:www-data public/storage/

# Windows (XAMPP/WAMP)
# Pastikan folder storage writable
```

## Keunggulan Sistem

1. **Struktur Sama**: Menggunakan pattern yang sama dengan Program Khusus Type yang sudah terbukti bekerja
2. **FileUpload Native**: Tidak ada masalah Livewire seperti sebelumnya
3. **Resource-based**: Lebih mudah maintenance dan extend
4. **API Ready**: Endpoint tunggal untuk semua data
5. **Flexible**: Mudah tambah/edit field baru
6. **🆕 Kualitas Gambar Tinggi**: Max 100MB, auto-resize optimal
7. **🆕 Frontend Ready**: Gambar langsung bisa pakai di website dengan kualitas bagus
8. **🆕 Image Processing**: Konfigurasi optimal untuk kualitas gambar

## Support

Jika ada masalah atau pertanyaan:
1. Cek error log Laravel di `storage/logs/laravel.log`
2. Pastikan semua file sudah dibuat dengan benar
3. Cek permission folder dan file
4. Restart web server jika diperlukan
5. **Gambar sekarang berkualitas tinggi** - tidak ada lagi masalah 6KB!
6. **Konfigurasi image processing** sudah dioptimasi

---

**Last Updated:** 11 Agustus 2025  
**Version:** 2.2 (Optimized Image Processing)  
**Status:** ✅ Working & Tested with High Quality Images



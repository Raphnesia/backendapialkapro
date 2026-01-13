# Sistem Manajemen Pimpinan SMP

## Overview
Sistem manajemen pimpinan SMP yang lengkap dengan backend Laravel dan frontend React/Next.js. Sistem ini memungkinkan admin untuk mengelola data pimpinan SMP, box keunggulan kepemimpinan, dan pengaturan halaman.

## Fitur Utama

### 1. Manajemen Pimpinan SMP
- ✅ Add/Edit data pimpinan SMP
- ✅ Upload foto pimpinan
- ✅ Upload banner desktop dan mobile
- ✅ Pengaturan urutan tampilan
- ✅ Status aktif/nonaktif
- ✅ Kategorisasi jabatan:
  - Kepala Sekolah
  - Wakil Kepala Sekolah Kurikulum
  - Wakil Kepala Sekolah Kesiswaan
  - Wakil Kepala Sekolah SDM & Humas
  - Wakil Kepala Sekolah AIK
  - Wakil Kepala Sekolah Sarana Prasarana

### 2. Manajemen Box Keunggulan Kepemimpinan
- ✅ Add/Edit box keunggulan
- ✅ Upload gambar box
- ✅ Pengaturan icon (emoji)
- ✅ Pengaturan warna background
- ✅ Pengaturan urutan tampilan
- ✅ Jumlah box fleksibel (tidak harus 6, bisa 7, 9, atau sesuai keinginan)

### 3. Pengaturan Halaman
- ✅ Edit title dan subtitle halaman
- ✅ Upload banner desktop dan mobile
- ✅ Edit text section keunggulan kepemimpinan
- ✅ Pengaturan status aktif/nonaktif

## Struktur Database

### 1. Tabel `pimpinan_s_m_p_s`
```sql
- id (primary key)
- name (string)
- position (string)
- photo (string, nullable)
- bio (text, nullable)
- education (string, nullable)
- experience (text, nullable)
- type (enum)
- order_index (integer)
- is_active (boolean)
- banner_desktop (string, nullable)
- banner_mobile (string, nullable)
- created_at, updated_at
```

### 2. Tabel `pimpinan_s_m_p_boxes`
```sql
- id (primary key)
- title (string)
- description (text)
- icon (string)
- image (string, nullable)
- background_color (string)
- order_index (integer)
- is_active (boolean)
- created_at, updated_at
```

### 3. Tabel `pimpinan_s_m_p_settings`
```sql
- id (primary key)
- title (string)
- subtitle (text)
- banner_desktop (string, nullable)
- banner_mobile (string, nullable)
- keunggulan_title (string)
- keunggulan_subtitle (text)
- is_active (boolean)
- created_at, updated_at
```

## Installation & Setup

### 1. Backend Setup

```bash
# Clone repository
git clone <repository-url>
cd school-backend

# Install dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure database in .env file
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Run migrations
php artisan migrate

# Run seeder
php artisan db:seed --class=PimpinanSMPSeeder

# Create storage link
php artisan storage:link

# Start server
php artisan serve
```

### 2. Admin Panel Access

Akses admin panel di: `http://localhost:8000/admin`

Navigasi untuk Pimpinan SMP:
- **Pimpinan SMP**: `/admin/pimpinan-s-m-p-s`
- **Box Keunggulan**: `/admin/pimpinan-s-m-p-boxes`
- **Pengaturan**: `/admin/pimpinan-s-m-p-settings`

## API Endpoints

### Base URL
```
http://localhost:8000/api/v1
```

### Endpoints

#### 1. Pimpinan SMP
- `GET /pimpinan-smp` - Get all pimpinan SMP
- `GET /pimpinan-smp/{id}` - Get pimpinan SMP by ID
- `GET /pimpinan-smp/type/{type}` - Get pimpinan SMP by type
- `GET /pimpinan-smp/kepala-sekolah` - Get kepala sekolah
- `GET /pimpinan-smp/wakil-kepala-sekolah` - Get wakil kepala sekolah

#### 2. Box Keunggulan
- `GET /pimpinan-smp/boxes` - Get all boxes

#### 3. Settings
- `GET /pimpinan-smp/settings` - Get settings

#### 4. Complete Data
- `GET /pimpinan-smp/complete` - Get all data (settings, pimpinan, boxes)

## Frontend Integration

### 1. Environment Setup
```env
NEXT_PUBLIC_API_BASE_URL=http://localhost:8000/api/v1
```

### 2. API Service
Buat file `lib/api.js` dengan service functions untuk mengakses API.

### 3. Component Implementation
Gunakan component `PimpinanSMPDetail` yang sudah disediakan dengan data dari API.

## Usage Examples

### 1. Mengelola Data Pimpinan SMP

#### Via Admin Panel
1. Buka `/admin/pimpinan-s-m-p-s`
2. Klik "Create" untuk menambah pimpinan baru
3. Isi form dengan data lengkap
4. Upload foto dan banner
5. Set urutan dan status
6. Save

#### Via API
```javascript
// Fetch all pimpinan
const response = await fetch('/api/v1/pimpinan-smp')
const data = await response.json()
```

### 2. Mengelola Box Keunggulan

#### Via Admin Panel
1. Buka `/admin/pimpinan-s-m-p-boxes`
2. Klik "Create" untuk menambah box baru
3. Isi judul, deskripsi, dan icon
4. Upload gambar (opsional)
5. Pilih warna background
6. Set urutan dan status
7. Save

#### Via API
```javascript
// Fetch all boxes
const response = await fetch('/api/v1/pimpinan-smp/boxes')
const data = await response.json()
```

### 3. Mengatur Pengaturan Halaman

#### Via Admin Panel
1. Buka `/admin/pimpinan-s-m-p-settings`
2. Edit title dan subtitle halaman
3. Upload banner desktop dan mobile
4. Edit text section keunggulan
5. Set status aktif
6. Save

#### Via API
```javascript
// Fetch settings
const response = await fetch('/api/v1/pimpinan-smp/settings')
const data = await response.json()
```

## Data Types

### Pimpinan SMP Types
- `kepala_sekolah` - Kepala Sekolah
- `wakil_kepala_sekolah_kurikulum` - Wakil Kepala Sekolah Kurikulum
- `wakil_kepala_sekolah_kesiswaan` - Wakil Kepala Sekolah Kesiswaan
- `wakil_kepala_sekolah_sdm_humas` - Wakil Kepala Sekolah SDM & Humas
- `wakil_kepala_sekolah_aik` - Wakil Kepala Sekolah AIK
- `wakil_kepala_sekolah_sarpras` - Wakil Kepala Sekolah Sarana Prasarana

### Background Colors
- `green-600` - Hijau
- `green-700` - Hijau Tua
- `blue-600` - Biru
- `blue-700` - Biru Tua
- `purple-600` - Ungu
- `purple-700` - Ungu Tua

## File Structure

```
school-backend/
├── app/
│   ├── Models/
│   │   ├── PimpinanSMP.php
│   │   ├── PimpinanSMPBox.php
│   │   └── PimpinanSMPSettings.php
│   ├── Http/Controllers/Api/
│   │   └── PimpinanSMPController.php
│   └── Filament/Resources/
│       ├── PimpinanSMPResource.php
│       ├── PimpinanSMPBoxResource.php
│       └── PimpinanSMPSettingsResource.php
├── database/
│   ├── migrations/
│   │   ├── create_pimpinan_s_m_p_s_table.php
│   │   ├── create_pimpinan_s_m_p_boxes_table.php
│   │   └── create_pimpinan_s_m_p_settings_table.php
│   └── seeders/
│       └── PimpinanSMPSeeder.php
├── routes/
│   └── api.php
├── PIMPINAN_SMP_API_DOCUMENTATION.md
├── FRONTEND_INTEGRATION_GUIDE.md
└── README_PIMPINAN_SMP.md
```

## Troubleshooting

### 1. Migration Error
```bash
# Reset database
php artisan migrate:fresh

# Run seeder
php artisan db:seed --class=PimpinanSMPSeeder
```

### 2. Storage Link Error
```bash
# Remove existing link
rm public/storage

# Create new link
php artisan storage:link
```

### 3. Permission Error
```bash
# Set storage permissions
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### 4. API Not Responding
```bash
# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear

# Restart server
php artisan serve
```

## Contributing

1. Fork repository
2. Create feature branch
3. Make changes
4. Test thoroughly
5. Submit pull request

## Support

Untuk bantuan dan dukungan:
- Dokumentasi API: `PIMPINAN_SMP_API_DOCUMENTATION.md`
- Panduan Frontend: `FRONTEND_INTEGRATION_GUIDE.md`
- Email: support@example.com

## License

This project is licensed under the MIT License. 
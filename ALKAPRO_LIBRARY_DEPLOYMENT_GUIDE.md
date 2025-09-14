# 🚀 Alkapro Library Deployment Guide

## Masalah: Pengaturan Alkapro Library Tidak Muncul di Admin Panel

Jika setelah pull dari Git, pengaturan Alkapro Library tidak muncul di admin panel hosting, ikuti langkah-langkah berikut:

---

## 🔧 Langkah 1: Jalankan Script Troubleshooting

Upload file `check_alkapro_library.php` ke root directory hosting Anda, lalu jalankan:

```bash
php check_alkapro_library.php
```

Script ini akan mengecek:
- ✅ File migration, model, resource, dan controller
- ✅ Koneksi database
- ✅ Apakah tabel sudah dibuat
- ✅ Apakah Filament resource bisa di-load

---

## 🚀 Langkah 2: Jalankan Deployment Script

### Opsi A: Menggunakan Script Bash (Linux/Unix hosting)
```bash
chmod +x deploy_alkapro_library.sh
./deploy_alkapro_library.sh
```

### Opsi B: Jalankan Manual (Semua hosting)
```bash
# 1. Jalankan migration
php artisan migrate --force

# 2. Clear semua cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# 3. Refresh autoload
composer dump-autoload

# 4. Clear Filament cache
php artisan filament:clear-cached-components

# 5. Optimize untuk production
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 🔍 Langkah 3: Verifikasi Manual

### 1. Cek File-file Penting
Pastikan file-file ini ada di hosting:

```
✅ database/migrations/2025_01_15_000000_create_alkapro_library_settings_table.php
✅ app/Models/AlkaproLibrarySettings.php
✅ app/Filament/Resources/AlkaproLibrarySettingsResource.php
✅ app/Filament/Resources/AlkaproLibrarySettingsResource/Pages/ListAlkaproLibrarySettings.php
✅ app/Filament/Resources/AlkaproLibrarySettingsResource/Pages/CreateAlkaproLibrarySettings.php
✅ app/Filament/Resources/AlkaproLibrarySettingsResource/Pages/EditAlkaproLibrarySettings.php
✅ app/Http/Controllers/Api/AlkaproLibraryController.php
```

### 2. Cek Database
Login ke database dan jalankan:

```sql
-- Cek apakah tabel ada
SHOW TABLES LIKE 'alkapro_library_settings';

-- Cek struktur tabel
DESCRIBE alkapro_library_settings;

-- Cek data (jika ada)
SELECT * FROM alkapro_library_settings LIMIT 1;
```

### 3. Cek Admin Panel
Setelah langkah di atas, login ke admin panel dan cari menu **"Alkapro Library Settings"**.

---

## 🐛 Troubleshooting Masalah Umum

### Problem 1: Migration Gagal
**Error**: `Table 'alkapro_library_settings' doesn't exist`

**Solution**:
```bash
php artisan migrate:status
php artisan migrate --force
```

### Problem 2: Filament Resource Tidak Muncul
**Error**: Menu tidak muncul di admin panel

**Solution**:
```bash
composer dump-autoload
php artisan filament:clear-cached-components
php artisan cache:clear
```

### Problem 3: Permission Error
**Error**: `Permission denied`

**Solution**:
```bash
# Set permission yang benar
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
chown -R www-data:www-data storage/
chown -R www-data:www-data bootstrap/cache/
```

### Problem 4: Composer Dependencies
**Error**: `Class not found`

**Solution**:
```bash
composer install --no-dev --optimize-autoloader
composer dump-autoload
```

---

## 📋 Checklist Deployment

Setelah deployment, pastikan:

- [ ] Migration berhasil dijalankan
- [ ] Tabel `alkapro_library_settings` ada di database
- [ ] Cache sudah di-clear
- [ ] Autoload sudah di-refresh
- [ ] Menu "Alkapro Library Settings" muncul di admin panel
- [ ] Bisa membuat/edit pengaturan library
- [ ] API endpoint `/api/v1/alkapro-library/complete` berfungsi

---

## 🔗 API Endpoints

Setelah berhasil, endpoint berikut akan tersedia:

```
GET /api/v1/alkapro-library/complete     - Data lengkap
GET /api/v1/alkapro-library/settings     - Settings saja
GET /api/v1/alkapro-library/gallery      - Gallery saja
GET /api/v1/alkapro-library/pamphlets    - Pamphlets saja
```

Test dengan:
```bash
curl -X GET "https://yourdomain.com/api/v1/alkapro-library/complete"
```

---

## 📞 Support

Jika masih ada masalah:

1. **Jalankan** `check_alkapro_library.php` dan kirim hasilnya
2. **Cek log error** di `storage/logs/laravel.log`
3. **Cek web server error log** (Apache/Nginx)
4. **Pastikan PHP version** minimal 8.1
5. **Pastikan Laravel version** minimal 10.x

---

## 🎯 Expected Result

Setelah berhasil, Anda akan melihat:

### Di Admin Panel:
- Menu **"Alkapro Library Settings"** 
- Form untuk mengatur:
  - Basic Info (Title, Subtitle, Banners)
  - Hero Section
  - Introduction Section
  - Features (Collection & Facility)
  - Gallery Settings
  - Programs (Reading Club, Digital Library)
  - Service Hours
  - Social Media
  - Call to Action

### Di Frontend:
- API endpoint yang mengembalikan data JSON
- Siap untuk implementasi React components
- SEO-friendly dengan meta tags

---

*Panduan ini dibuat untuk memastikan Alkapro Library berhasil di-deploy di hosting production.*

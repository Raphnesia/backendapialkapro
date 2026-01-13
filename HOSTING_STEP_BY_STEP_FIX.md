# Panduan Langkah demi Langkah: Fix Alkapro Library di Hosting

## Masalah
Setelah `git pull origin main`, menu **Pengaturan Alkapro Library** tidak muncul di Filament admin panel.

## Solusi Cepat (Jalankan di Terminal Hosting)

### LANGKAH 1: Jalankan Script Otomatis
```bash
php fix_hosting_alkapro_library.php
```

Jika script di atas tidak bisa dijalankan, ikuti langkah manual di bawah:

---

## Solusi Manual

### LANGKAH 1: Cek File Ada atau Tidak
```bash
ls -la app/Models/AlkaproLibrarySettings.php
ls -la app/Filament/Resources/AlkaproLibrarySettingsResource.php
ls -la database/migrations/2025_01_15_000000_create_alkapro_library_settings_table.php
```

**Jika file tidak ada:** Git pull belum berhasil, ulangi `git pull origin main`

### LANGKAH 2: Jalankan Migration (PALING PENTING!)
```bash
php artisan migrate
```

**Atau jalankan migration spesifik:**
```bash
php artisan migrate --path=database/migrations/2025_01_15_000000_create_alkapro_library_settings_table.php
```

### LANGKAH 3: Clear Cache
```bash
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### LANGKAH 4: Optimize Autoloader
```bash
composer dump-autoload
php artisan optimize
```

### LANGKAH 5: Manual Cache Clear (Jika Masih Error)
```bash
rm -rf bootstrap/cache/*.php
rm -rf storage/framework/cache/data/*
rm -rf storage/framework/views/*
```

### LANGKAH 6: Set Permission
```bash
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
```

### LANGKAH 7: Restart Web Server (Jika Bisa)
```bash
# Untuk Apache
sudo systemctl restart apache2

# Untuk Nginx  
sudo systemctl restart nginx

# Untuk shared hosting, skip langkah ini
```

---

## Verifikasi

### Cek Database Connection
```bash
php artisan tinker
>>> DB::connection()->getPdo();
>>> exit
```

### Cek Apakah Table Sudah Ada
```bash
php artisan tinker
>>> DB::select("SHOW TABLES LIKE 'alkapro_library_settings'");
>>> exit
```

### Cek Filament Resources
```bash
php artisan filament:list-resources
```

---

## Hasil yang Diharapkan

Setelah langkah-langkah di atas, di Filament admin panel Anda akan melihat:

```
📁 Perpustakaan
   📖 Pengaturan Alkapro Library
```

Menu ini akan memiliki 6 tab:
1. **Pengaturan Dasar** - Title, subtitle, banner
2. **Konten** - Introduction, features
3. **Galeri & Media** - Gallery, pamphlets
4. **Program & Layanan** - Reading club, digital library
5. **Jam Layanan & Kontak** - Service hours, social media
6. **CTA & SEO** - Call to action, meta tags

---

## Troubleshooting

### Jika Masih Tidak Muncul:

1. **Cek Error Log:**
   ```bash
   tail -f storage/logs/laravel.log
   ```

2. **Force Clear Everything:**
   ```bash
   php artisan optimize:clear
   php artisan filament:optimize
   ```

3. **Cek Database Credentials di .env:**
   ```
   DB_CONNECTION=mysql
   DB_HOST=localhost
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

4. **Restart Browser & Clear Browser Cache**

5. **Pastikan Login sebagai Admin User**

---

## Jika Semua Gagal

Jalankan perintah ini dan kirim outputnya:

```bash
php fix_hosting_alkapro_library.php > debug_output.txt
cat debug_output.txt
```

---

## Catatan Penting

- **Migration adalah kunci utama** - tanpa migration, table tidak ada, Filament resource tidak akan muncul
- **Database connection harus working** - jika database error, Filament tidak bisa discover resources
- **Cache clearing penting** - hosting sering cache agresif

## Quick Commands (Copy-Paste)

```bash
# All-in-one fix command
php artisan migrate && php artisan config:clear && php artisan route:clear && php artisan view:clear && composer dump-autoload && php artisan optimize

# Check if working
php artisan filament:list-resources
```

Setelah menjalankan perintah di atas, refresh halaman Filament admin Anda!

# Panduan Deploy Popup Settings ke Hosting

## Langkah-langkah Deploy

### 1. SSH ke Server Hosting

```bash
ssh user@your-server.com
# atau
ssh user@your-server-ip
```

### 2. Navigate ke Direktori Project

```bash
cd /path/to/your/project
# Contoh: cd /home/username/public_html
# atau: cd /var/www/html
```

### 3. Pull Perubahan dari GitHub

```bash
# Pastikan Anda di branch main
git checkout main

# Pull perubahan terbaru
git pull origin main
```

### 4. Install Dependencies (jika diperlukan)

```bash
# Install/update composer dependencies
composer install --no-dev --optimize-autoloader
```

### 5. Jalankan Migration

```bash
# Jalankan migration untuk membuat tabel popup_settings
php artisan migrate --force
```

**Catatan:** Flag `--force` diperlukan untuk menjalankan migration di production tanpa konfirmasi.

### 6. Clear Cache

```bash
# Clear semua cache
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

### 7. Optimize (Opsional, untuk Production)

```bash
# Cache config, routes, dan views untuk performa lebih baik
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Menggunakan Script Otomatis

Jika Anda sudah upload file `deploy_popup_settings.sh` ke server:

```bash
# Berikan permission execute
chmod +x deploy_popup_settings.sh

# Jalankan script
./deploy_popup_settings.sh
```

## Verifikasi

Setelah deploy, verifikasi bahwa:

1. ✅ Tabel `popup_settings` sudah dibuat di database
2. ✅ Route API `/api/v1/popup-settings` dapat diakses
3. ✅ Menu "Popup Settings" muncul di Filament admin panel

### Test API

```bash
# Test endpoint popup settings
curl https://api.alkapro.id/api/v1/popup-settings
```

### Test di Browser

1. Login ke Filament admin panel
2. Buka menu **Settings** → **Popup Settings**
3. Coba buat popup baru

## Troubleshooting

### Error: "Migration table not found"
```bash
php artisan migrate:install
php artisan migrate --force
```

### Error: "Permission denied"
```bash
# Pastikan permission folder storage dan bootstrap/cache
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### Error: "Class not found"
```bash
# Clear dan regenerate autoload
composer dump-autoload
php artisan optimize:clear
```

### Rollback Migration (jika diperlukan)
```bash
php artisan migrate:rollback --step=1
```

## Checklist Deploy

- [ ] SSH ke server hosting
- [ ] Navigate ke direktori project
- [ ] Pull dari GitHub (`git pull origin main`)
- [ ] Install dependencies (`composer install`)
- [ ] Jalankan migration (`php artisan migrate --force`)
- [ ] Clear cache (`php artisan optimize:clear`)
- [ ] Test API endpoint
- [ ] Test di Filament admin panel
- [ ] Verifikasi menu Popup Settings muncul

## Catatan Penting

1. **Backup Database**: Sebelum menjalankan migration, pastikan sudah backup database
2. **Maintenance Mode**: Untuk production, pertimbangkan untuk enable maintenance mode saat deploy:
   ```bash
   php artisan down
   # ... lakukan deploy ...
   php artisan up
   ```
3. **Environment**: Pastikan file `.env` sudah dikonfigurasi dengan benar
4. **Storage Link**: Pastikan symbolic link untuk storage sudah dibuat:
   ```bash
   php artisan storage:link
   ```

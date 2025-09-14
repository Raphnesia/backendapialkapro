#!/bin/bash

echo "=== ALKAPRO LIBRARY HOSTING DEPLOYMENT FIX ==="
echo ""

echo "LANGKAH 1: Cek apakah file sudah ada di hosting"
echo "Jalankan perintah ini di terminal hosting:"
echo ""
echo "ls -la app/Models/AlkaproLibrarySettings.php"
echo "ls -la app/Filament/Resources/AlkaproLibrarySettingsResource.php"
echo "ls -la database/migrations/2025_01_15_000000_create_alkapro_library_settings_table.php"
echo ""

echo "LANGKAH 2: Jalankan migration (PENTING!)"
echo "php artisan migrate"
echo ""

echo "LANGKAH 3: Clear semua cache"
echo "php artisan optimize:clear"
echo "php artisan config:clear"
echo "php artisan route:clear"
echo "php artisan view:clear"
echo ""

echo "LANGKAH 4: Jika masih error database, coba manual cache clear"
echo "rm -rf bootstrap/cache/*.php"
echo "rm -rf storage/framework/cache/data/*"
echo "rm -rf storage/framework/views/*"
echo ""

echo "LANGKAH 5: Set permission yang benar"
echo "chmod -R 755 storage/"
echo "chmod -R 755 bootstrap/cache/"
echo ""

echo "LANGKAH 6: Restart web server (jika memungkinkan)"
echo "# Untuk Apache:"
echo "sudo systemctl restart apache2"
echo "# Untuk Nginx:"
echo "sudo systemctl restart nginx"
echo ""

echo "LANGKAH 7: Test database connection"
echo "php artisan tinker"
echo ">>> DB::connection()->getPdo();"
echo ">>> exit"
echo ""

echo "LANGKAH 8: Cek apakah resource terdaftar"
echo "php artisan filament:list-resources"
echo ""

echo "JIKA MASIH TIDAK MUNCUL, jalankan perintah ini:"
echo "php artisan filament:optimize"
echo "php artisan optimize"
echo ""

echo "=== SELESAI ==="

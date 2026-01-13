#!/bin/bash

# Script untuk deploy Popup Settings dari GitHub ke hosting
# Jalankan script ini di server hosting setelah SSH

echo "🚀 Starting deployment of Popup Settings..."

# 1. Pull perubahan dari GitHub
echo "📥 Pulling latest changes from GitHub..."
git pull origin main

# 2. Install dependencies jika ada perubahan di composer.json
echo "📦 Checking dependencies..."
composer install --no-dev --optimize-autoloader

# 3. Jalankan migration untuk tabel popup_settings
echo "🗄️  Running migrations..."
php artisan migrate --force

# 4. Clear cache
echo "🧹 Clearing cache..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# 5. Optimize (opsional, untuk production)
echo "⚡ Optimizing application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Deployment completed successfully!"
echo "📝 Don't forget to check Filament admin panel: Settings → Popup Settings"

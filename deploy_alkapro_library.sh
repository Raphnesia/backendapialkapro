#!/bin/bash

echo "🚀 Deploying Alkapro Library Settings..."

# 1. Run migrations
echo "📦 Running migrations..."
php artisan migrate --force

# 2. Clear all caches
echo "🧹 Clearing caches..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# 3. Refresh autoload
echo "🔄 Refreshing autoload..."
composer dump-autoload

# 4. Clear Filament cache specifically
echo "🎨 Clearing Filament cache..."
php artisan filament:clear-cached-components

# 5. Optimize for production
echo "⚡ Optimizing for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Deployment complete! Alkapro Library should now be available in admin panel."
echo ""
echo "📋 Manual steps if needed:"
echo "1. Check if migration file exists: database/migrations/2025_01_15_000000_create_alkapro_library_settings_table.php"
echo "2. Verify table created: SELECT * FROM alkapro_library_settings LIMIT 1;"
echo "3. Check Filament resource: app/Filament/Resources/AlkaproLibrarySettingsResource.php"
echo ""
echo "🔗 Admin panel should show 'Alkapro Library Settings' in the menu"

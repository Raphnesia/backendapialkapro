# Fix Git Repository di Hosting

## Masalah
1. Permission denied pada vendor folder
2. "You do not have the initial commit yet" - repository belum ter-setup

## Solusi

### Step 1: Fix Permission Issues

```bash
# Fix permission untuk vendor folder (jika diperlukan)
# Biasanya vendor tidak perlu di-commit, jadi kita bisa skip

# Atau jika perlu, fix permission:
sudo chown -R alkaproi:alkaproi vendor/
# atau
chmod -R 755 vendor/
```

### Step 2: Setup Git Repository

Karena repository belum ter-setup dengan benar, kita perlu:

#### Opsi A: Clone Fresh dari GitHub (Recommended)

```bash
# 1. Backup file penting
cd /path/to/parent/directory
cp -r api.alkapro.id api.alkapro.id.backup

# 2. Backup .env
cp api.alkapro.id/.env api.alkapro.id/.env.backup

# 3. Clone fresh dari GitHub
git clone https://github.com/Raphnesia/backendapialkapro.git api.alkapro.id.new

# 4. Copy file penting dari backup
cp api.alkapro.id.backup/.env api.alkapro.id.new/.env
cp -r api.alkapro.id.backup/storage/* api.alkapro.id.new/storage/
cp -r api.alkapro.id.backup/public/storage api.alkapro.id.new/public/ 2>/dev/null || true

# 5. Rename
mv api.alkapro.id api.alkapro.id.old
mv api.alkapro.id.new api.alkapro.id

# 6. Install dependencies
cd api.alkapro.id
composer install --no-dev --optimize-autoloader

# 7. Jalankan migration
php artisan migrate --force

# 8. Clear cache
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

#### Opsi B: Initialize Repository Baru dan Connect ke GitHub

```bash
# 1. Backup .env
cp .env .env.backup

# 2. Initialize git repository
git init

# 3. Add remote
git remote add origin https://github.com/Raphnesia/backendapialkapro.git

# 4. Fetch dari GitHub
git fetch origin

# 5. Checkout branch main
git checkout -b main origin/main

# 6. Restore .env
cp .env.backup .env

# 7. Install dependencies
composer install --no-dev --optimize-autoloader

# 8. Jalankan migration
php artisan migrate --force

# 9. Clear cache
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

#### Opsi C: Force Pull (Jika repository sudah ada tapi belum commit)

```bash
# 1. Backup .env
cp .env .env.backup

# 2. Remove .git jika ada masalah
rm -rf .git

# 3. Initialize baru
git init

# 4. Add remote
git remote add origin https://github.com/Raphnesia/backendapialkapro.git

# 5. Fetch dan checkout
git fetch origin
git checkout -b main origin/main

# 6. Restore .env
cp .env.backup .env

# 7. Install dependencies
composer install --no-dev --optimize-autoloader

# 8. Jalankan migration
php artisan migrate --force

# 9. Clear cache
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Script Otomatis (Recommended)

Buat file `setup_git.sh`:

```bash
#!/bin/bash

echo "🔧 Setting up Git repository..."

# Backup .env
echo "📦 Backing up .env..."
cp .env .env.backup 2>/dev/null || echo "⚠️  .env not found, will create new one"

# Remove old .git if exists
echo "🗑️  Removing old .git..."
rm -rf .git

# Initialize new repository
echo "🆕 Initializing new repository..."
git init

# Add remote
echo "🔗 Adding remote..."
git remote add origin https://github.com/Raphnesia/backendapialkapro.git

# Fetch from GitHub
echo "📥 Fetching from GitHub..."
git fetch origin

# Checkout main branch
echo "🌿 Checking out main branch..."
git checkout -b main origin/main

# Restore .env
echo "♻️  Restoring .env..."
if [ -f .env.backup ]; then
    cp .env.backup .env
    echo "✅ .env restored"
else
    echo "⚠️  No .env backup found, please configure .env manually"
fi

# Install dependencies
echo "📦 Installing dependencies..."
composer install --no-dev --optimize-autoloader

# Run migration
echo "🗄️  Running migrations..."
php artisan migrate --force

# Clear and optimize cache
echo "🧹 Clearing cache..."
php artisan optimize:clear

echo "⚡ Optimizing..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Setup completed!"
echo "📝 Please check your .env file and configure if needed"
```

Jalankan:
```bash
chmod +x setup_git.sh
./setup_git.sh
```

## Setelah Setup

### Verifikasi

```bash
# Cek git status
git status

# Cek remote
git remote -v

# Cek branch
git branch

# Test API
curl https://api.alkapro.id/api/v1/popup-settings
```

### Untuk Update Selanjutnya

Setelah repository ter-setup dengan benar, untuk update selanjutnya cukup:

```bash
# Pull perubahan
git pull origin main

# Jalankan migration jika ada
php artisan migrate --force

# Clear cache
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Troubleshooting

### Permission Issues dengan Vendor

Vendor folder biasanya tidak perlu di-commit. Pastikan `.gitignore` sudah benar:

```bash
# Cek .gitignore
cat .gitignore | grep vendor

# Jika vendor tidak ada di .gitignore, tambahkan:
echo "vendor/" >> .gitignore
```

### Jika Masih Ada Permission Issues

```bash
# Fix ownership (ganti dengan user dan group yang benar)
sudo chown -R alkaproi:alkaproi .

# Atau fix permission
chmod -R 755 .
chmod -R 775 storage bootstrap/cache
```

### Jika .env Hilang

```bash
# Copy dari example
cp .env.example .env

# Edit dengan konfigurasi yang benar
nano .env
# atau
vi .env
```

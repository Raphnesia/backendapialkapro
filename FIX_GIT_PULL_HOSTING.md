# Solusi Error Git Pull di Hosting

## Masalah
Error: "The following untracked working tree files would be overwritten by merge"

Ini terjadi karena ada file-file di hosting yang belum di-track oleh git, dan file-file tersebut juga ada di GitHub.

## Solusi

### Opsi 1: Stash File Lokal (Recommended)

```bash
# 1. Backup file .env terlebih dahulu (PENTING!)
cp .env .env.backup

# 2. Stash semua perubahan lokal (termasuk untracked files)
git stash --include-untracked

# 3. Pull dari GitHub
git pull origin main

# 4. Restore file .env dari backup
cp .env.backup .env

# 5. Jika ada perubahan lain yang perlu di-restore
git stash pop
```

### Opsi 2: Force Pull (Hati-hati - akan overwrite file lokal)

```bash
# 1. Backup file .env terlebih dahulu (PENTING!)
cp .env .env.backup

# 2. Reset hard ke remote (akan menghapus semua perubahan lokal)
git fetch origin
git reset --hard origin/main

# 3. Restore file .env dari backup
cp .env.backup .env
```

### Opsi 3: Add dan Commit File Lokal Dulu

```bash
# 1. Add semua file yang ada
git add -A

# 2. Commit dengan message
git commit -m "Save local changes before pull"

# 3. Pull dengan allow unrelated histories
git pull origin main --allow-unrelated-histories

# 4. Resolve conflicts jika ada
# (Ikuti instruksi yang muncul)
```

## Langkah-langkah Lengkap (Recommended)

### Step 1: Backup File Penting
```bash
# Backup .env (sangat penting!)
cp .env .env.backup

# Buat folder backup untuk file penting lainnya
mkdir -p backup_files
```

### Step 2: Stash Perubahan
```bash
# Stash semua perubahan termasuk untracked files
git stash push -u -m "Backup before pull"
```

### Step 3: Pull dari GitHub
```bash
# Pull perubahan terbaru
git pull origin main
```

### Step 4: Restore File Penting
```bash
# Restore .env
cp .env.backup .env

# Hapus backup jika sudah tidak diperlukan
rm .env.backup
```

### Step 5: Jalankan Migration dan Clear Cache
```bash
# Jalankan migration untuk popup_settings
php artisan migrate --force

# Clear cache
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Optimize untuk production
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Script Otomatis

Buat file `fix_pull.sh` di hosting:

```bash
#!/bin/bash

echo "🔄 Fixing git pull..."

# Backup .env
echo "📦 Backing up .env..."
cp .env .env.backup

# Stash changes
echo "💾 Stashing local changes..."
git stash push -u -m "Backup before pull $(date)"

# Pull from GitHub
echo "📥 Pulling from GitHub..."
git pull origin main

# Restore .env
echo "♻️  Restoring .env..."
cp .env.backup .env

# Run migration
echo "🗄️  Running migrations..."
php artisan migrate --force

# Clear cache
echo "🧹 Clearing cache..."
php artisan optimize:clear

# Optimize
echo "⚡ Optimizing..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Done!"
```

Jalankan:
```bash
chmod +x fix_pull.sh
./fix_pull.sh
```

## Catatan Penting

1. **JANGAN LUPA BACKUP .env** - File ini berisi konfigurasi penting dan tidak ada di GitHub
2. Jika menggunakan Opsi 2 (Force Pull), semua perubahan lokal akan hilang
3. Setelah pull, pastikan jalankan migration untuk membuat tabel `popup_settings`
4. Clear cache setelah pull untuk memastikan perubahan ter-load

## Troubleshooting

### Jika masih error setelah stash:
```bash
# Cek status
git status

# Jika masih ada file yang conflict, hapus manual
rm -f file_yang_conflict.txt

# Lalu pull lagi
git pull origin main
```

### Jika .env hilang:
```bash
# Restore dari backup
cp .env.backup .env

# Atau copy dari template
cp .env.example .env
# Lalu edit .env dengan konfigurasi yang benar
```

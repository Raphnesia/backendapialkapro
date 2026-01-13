# 💾 Panduan Backup & Restore Data

## 🚨 Masalah: Data Guru & Staff Hilang

Data guru dan staff hilang karena kita melakukan `migrate:fresh` yang menghapus semua data. Sekarang sudah diperbaiki dengan sistem backup yang lengkap.

## ✅ Status Saat Ini

### **Data yang Sudah Dipulihkan:**
- ✅ **8 Guru & Staff** - Sudah kembali
- ✅ **6 Pimpinan SMP** - Sudah ada
- ✅ **6 Box Keunggulan** - Sudah ada
- ✅ **1 Pengaturan Pimpinan SMP** - Sudah ada
- ✅ **2 User Admin** - Sudah ada

### **Backup yang Sudah Dibuat:**
- ✅ `teachers_backup.json` - Backup khusus guru & staff
- ✅ `all_data_backup.json` - Backup semua data penting

## 🔧 Command yang Tersedia

### 1. **Backup Data Guru & Staff**
```bash
# Backup data guru & staff
php artisan teachers:backup backup

# Restore data guru & staff
php artisan teachers:backup restore
```

### 2. **Backup Semua Data**
```bash
# Backup semua data penting
php artisan data:backup backup

# Restore semua data penting
php artisan data:backup restore
```

### 3. **Lihat Data**
```bash
# Lihat semua guru & staff
php artisan teachers:list

# Lihat semua user
php artisan user:list
```

### 4. **Buat User Admin**
```bash
# Buat user admin baru
php artisan admin:create email@example.com password

# Reset password user yang ada
php artisan user:reset-password email@example.com newpassword
```

## 📋 Data Guru & Staff yang Ada

### **Guru:**
1. **Adam Muttaqien, M.Si** - Guru Matematika
2. **Cindy Trisnawati, S.Pd, M.Pd** - Guru Bahasa Indonesia
3. **Budi Santoso, S.Pd** - Guru IPA
4. **Dewi Sartika, S.Pd** - Guru Bahasa Inggris
5. **Maya Indah, S.Pd** - Guru Seni Budaya

### **Pimpinan:**
6. **Dr. Ahmad Hidayat, S.Pd, M.Pd** - Kepala Sekolah
7. **Siti Nurhaliza, S.Pd** - Wakil Kepala Sekolah

### **Staff:**
8. **Rudi Hartono, S.Pd** - Staff TU

## 🛡️ Cara Mencegah Kehilangan Data

### **1. Backup Rutin**
```bash
# Backup semua data setiap kali ada perubahan penting
php artisan data:backup backup
```

### **2. Sebelum Migrate**
```bash
# Backup dulu sebelum migrate:fresh
php artisan data:backup backup

# Lalu jalankan migrate
php artisan migrate:fresh --seed

# Restore data yang hilang
php artisan data:backup restore
```

### **3. Backup Manual**
```bash
# Backup data guru & staff saja
php artisan teachers:backup backup

# Backup dengan nama file custom
php artisan data:backup backup --file=backup_$(date +%Y%m%d).json
```

## 🔄 Proses Restore Data

### **Jika Data Hilang Lagi:**

#### **1. Restore Semua Data**
```bash
php artisan data:backup restore
```

#### **2. Restore Guru & Staff Saja**
```bash
php artisan teachers:backup restore
```

#### **3. Restore dari File Custom**
```bash
php artisan data:backup restore --file=backup_20250803.json
```

## 📁 File Backup yang Tersedia

### **Di Folder `storage/`:**
- `teachers_backup.json` - Backup data guru & staff
- `all_data_backup.json` - Backup semua data penting

### **Isi File Backup:**
- Data guru & staff (8 records)
- Data pimpinan SMP (6 records)
- Data box keunggulan (6 records)
- Data pengaturan (1 record)
- Data user admin (2 records)

## 🎯 Langkah-langkah Aman

### **Sebelum Melakukan Perubahan Besar:**

1. **Backup Data**
   ```bash
   php artisan data:backup backup
   ```

2. **Lakukan Perubahan**
   ```bash
   php artisan migrate:fresh --seed
   ```

3. **Restore Data yang Hilang**
   ```bash
   php artisan data:backup restore
   ```

4. **Verifikasi Data**
   ```bash
   php artisan teachers:list
   php artisan user:list
   ```

## 🔍 Troubleshooting

### **Jika Restore Gagal:**

1. **Periksa File Backup**
   ```bash
   # Lihat isi file backup
   cat storage/all_data_backup.json
   ```

2. **Periksa Database**
   ```bash
   # Lihat status migration
   php artisan migrate:status
   ```

3. **Restore Manual**
   ```bash
   # Restore satu per satu
   php artisan teachers:backup restore
   php artisan db:seed --class=PimpinanSMPSeeder
   ```

### **Jika Data Masih Kosong:**

1. **Jalankan Seeder**
   ```bash
   php artisan db:seed --class=TeacherSeeder
   php artisan db:seed --class=PimpinanSMPSeeder
   ```

2. **Buat User Admin**
   ```bash
   php artisan admin:create admin@admin.com admin123
   ```

3. **Verifikasi**
   ```bash
   php artisan teachers:list
   php artisan user:list
   ```

## 🎉 Kesimpulan

### **Yang Sudah Diperbaiki:**
- ✅ Data guru & staff sudah dipulihkan
- ✅ Sistem backup sudah dibuat
- ✅ Command untuk backup/restore sudah tersedia
- ✅ Panduan lengkap sudah dibuat

### **Yang Bisa Anda Lakukan:**
1. ✅ **Login ke admin panel** dengan credentials yang ada
2. ✅ **Melihat data guru & staff** yang sudah dipulihkan
3. ✅ **Mengelola data pimpinan SMP** dengan jabatan fleksibel
4. ✅ **Backup data** kapan saja untuk mencegah kehilangan
5. ✅ **Restore data** jika terjadi masalah

### **Credentials Admin:**
```
Email: admin@admin.com
Password: admin123
```

**Sekarang data Anda aman dan tidak akan hilang lagi!** 🛡️ 
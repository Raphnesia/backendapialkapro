# 🔐 Panduan Troubleshooting Login Filament Admin

## Masalah: "These credentials do not match our records"

### ✅ Solusi yang Telah Dibuat

Saya telah membuat beberapa command untuk mengatasi masalah login:

#### 1. **User Admin Baru**
```bash
php artisan admin:create admin@admin.com admin123
```

#### 2. **Reset Password User yang Ada**
```bash
php artisan user:reset-password test@example.com admin123
```

#### 3. **Lihat Semua User**
```bash
php artisan user:list
```

## 🚀 Cara Login Sekarang

### **Option 1: User Admin Baru**
```
Email: admin@admin.com
Password: admin123
```

### **Option 2: User yang Sudah Ada**
```
Email: test@example.com
Password: admin123
```

## 📋 Langkah-langkah Login

1. **Buka Admin Panel:**
   ```
   http://localhost:8000/admin
   ```

2. **Masukkan Credentials:**
   - Email: `admin@admin.com` atau `test@example.com`
   - Password: `admin123`

3. **Klik Login**

## 🔧 Jika Masih Bermasalah

### 1. **Clear Cache**
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### 2. **Restart Server**
```bash
php artisan serve
```

### 3. **Buat User Baru**
```bash
php artisan admin:create your-email@example.com your-password
```

### 4. **Reset Password User Lain**
```bash
php artisan user:reset-password your-email@example.com new-password
```

## 🎯 Command yang Tersedia

### **Membuat Admin Baru**
```bash
php artisan admin:create {email} {password}
```
Contoh:
```bash
php artisan admin:create admin@school.com admin123
```

### **Reset Password**
```bash
php artisan user:reset-password {email} {password}
```
Contoh:
```bash
php artisan user:reset-password admin@school.com newpassword123
```

### **Lihat Semua User**
```bash
php artisan user:list
```

## 🔍 Troubleshooting Lanjutan

### **Jika Masih Tidak Bisa Login:**

1. **Periksa Database Connection**
   ```bash
   php artisan migrate:status
   ```

2. **Periksa User di Database**
   ```bash
   php artisan user:list
   ```

3. **Buat User Baru dengan Email Berbeda**
   ```bash
   php artisan admin:create newadmin@example.com password123
   ```

4. **Periksa File .env**
   Pastikan konfigurasi database benar:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

## 🎉 Credentials yang Siap Digunakan

### **User 1:**
```
Email: admin@admin.com
Password: admin123
```

### **User 2:**
```
Email: test@example.com
Password: admin123
```

## 📞 Jika Masih Bermasalah

1. **Periksa apakah server Laravel berjalan:**
   ```bash
   php artisan serve
   ```

2. **Periksa apakah database terhubung:**
   ```bash
   php artisan migrate:status
   ```

3. **Buat user baru dengan email yang berbeda:**
   ```bash
   php artisan admin:create your-email@example.com your-password
   ```

4. **Pastikan tidak ada error di console browser**

---

**Sekarang Anda bisa login dengan credentials yang telah dibuat!** 🚀 
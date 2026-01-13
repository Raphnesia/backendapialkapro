# 🔧 Troubleshooting Upload Banner Sejarah Singkat

## 🎯 Masalah yang Ditemukan

**Banner desktop dan mobile tidak terupload** saat menggunakan admin panel Filament.

## ✅ Solusi yang Telah Diterapkan

### **1. Perbaikan Model SejarahSingkatSettings**
- ✅ **Menghapus mutator** yang bermasalah
- ✅ **Menambahkan accessor** untuk URL yang benar
- ✅ **Menggunakan asset() helper** untuk URL yang tepat

### **2. Perbaikan Filament Resource**
- ✅ **Menambahkan disk('public')** ke FileUpload
- ✅ **Menambahkan directory('sejarah-singkat')** ke FileUpload
- ✅ **Konfigurasi yang benar** untuk file upload

### **3. Perbaikan Storage**
- ✅ **Membuat folder** `storage/app/public/sejarah-singkat`
- ✅ **Mengatur permissions** folder storage
- ✅ **Memastikan storage link** berfungsi

## 🔧 Cara Test Upload Banner

### **1. Login ke Admin Panel**
```
URL: http://localhost:8000/admin
Email: admin@admin.com
Password: admin123
```

### **2. Akses Pengaturan Sejarah Singkat**
1. Klik menu **"Pengaturan Sejarah Singkat"**
2. Klik **"Edit"** data yang ada
3. Scroll ke section **"Banner Images"**

### **3. Upload Banner**
1. **Banner Desktop**: Upload gambar dengan rasio 16:9 (1920x1080px)
2. **Banner Mobile**: Upload gambar dengan rasio 16:9 (800x450px)
3. Klik **"Save"**

### **4. Verifikasi Upload**
1. Cek folder `public/storage/sejarah-singkat/`
2. File seharusnya muncul di folder tersebut
3. URL file: `http://localhost:8000/storage/sejarah-singkat/[filename]`

## 🚨 Jika Masih Bermasalah

### **1. Cek Storage Link**
```bash
# Cek apakah storage link ada
dir public\storage

# Jika tidak ada, buat ulang
php artisan storage:link
```

### **2. Cek Permissions**
```bash
# Berikan permissions penuh ke folder storage
icacls storage\app\public\sejarah-singkat /grant "Everyone:(OI)(CI)F"
```

### **3. Clear Cache**
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
```

### **4. Cek Disk Configuration**
Pastikan di `config/filesystems.php`:
```php
'public' => [
    'driver' => 'local',
    'root' => storage_path('app/public'),
    'url' => env('APP_URL').'/storage',
    'visibility' => 'public',
],
```

### **5. Test File Upload**
```bash
# Jalankan script test
php test_upload.php
```

## 📁 Struktur File yang Benar

### **Setelah Upload Berhasil:**
```
public/storage/sejarah-singkat/
├── banner_desktop_123456.jpg
├── banner_mobile_123456.jpg
└── ...
```

### **URL yang Benar:**
```
http://localhost:8000/storage/sejarah-singkat/banner_desktop_123456.jpg
http://localhost:8000/storage/sejarah-singkat/banner_mobile_123456.jpg
```

## 🔍 Debug Steps

### **1. Cek Log Laravel**
```bash
# Lihat log error
tail -f storage/logs/laravel.log
```

### **2. Cek Network Tab**
1. Buka Developer Tools di browser
2. Buka tab Network
3. Upload file dan lihat request/response

### **3. Cek Database**
```bash
# Cek apakah data tersimpan
php artisan tinker
>>> App\Models\SejarahSingkatSettings::first()->banner_desktop
```

## 🎯 Expected Behavior

### **Setelah Upload Berhasil:**
1. ✅ File tersimpan di `storage/app/public/sejarah-singkat/`
2. ✅ File dapat diakses via `http://localhost:8000/storage/sejarah-singkat/[filename]`
3. ✅ Data tersimpan di database dengan path relatif
4. ✅ Admin panel menampilkan preview gambar

### **API Response:**
```json
{
  "success": true,
  "data": {
    "banner_desktop": "http://localhost:8000/storage/sejarah-singkat/banner_desktop_123456.jpg",
    "banner_mobile": "http://localhost:8000/storage/sejarah-singkat/banner_mobile_123456.jpg"
  }
}
```

## 🚀 Next Steps

### **Jika Upload Berhasil:**
1. ✅ Test API endpoint `/sejarah-singkat/settings`
2. ✅ Verifikasi URL banner di response
3. ✅ Test di frontend dengan URL banner

### **Jika Masih Bermasalah:**
1. 🔍 Cek log Laravel untuk error detail
2. 🔍 Test dengan file kecil (< 1MB)
3. 🔍 Cek apakah ada error di browser console
4. 🔍 Verifikasi folder permissions

## 📞 Support

Jika masih mengalami masalah, mohon berikan:
1. **Error message** dari log Laravel
2. **Screenshot** dari admin panel
3. **File size** yang dicoba upload
4. **Browser** yang digunakan

---

**Upload banner seharusnya sudah berfungsi setelah perbaikan ini!** 🚀 
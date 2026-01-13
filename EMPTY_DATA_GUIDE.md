# 📝 Panduan Mengisi Data Kosong

## ✅ Status Saat Ini

**Data dummy sudah dihapus dan diganti dengan struktur kosong:**

- ✅ **1 Teacher kosong** - Siap diisi dengan data asli
- ✅ **1 Pimpinan SMP Settings** - Siap dikustomisasi
- ✅ **6 Pimpinan SMP Boxes** - Siap diisi dengan keunggulan kepemimpinan
- ✅ **0 Pimpinan SMP** - Siap ditambahkan

## 🔧 Cara Mengisi Data

### **1. Login ke Admin Panel**
```
URL: http://localhost:8000/admin
Email: admin@admin.com
Password: admin123
```

### **2. Mengisi Data Guru & Staff**

#### **Langkah-langkah:**
1. Login ke admin panel
2. Klik menu **"Guru & Staff"** di sidebar
3. Klik **"Create Guru & Staff"** atau **"Edit"** data yang kosong
4. Isi data:
   - **Name**: Nama lengkap guru/staff
   - **Subject**: Mata pelajaran (untuk guru)
   - **Position**: Jabatan/posisi
   - **Type**: Pilih `teacher`, `principal`, `vice_principal`, atau `staff`
   - **Photo**: Upload foto (opsional)
   - **Bio**: Biografi singkat
   - **Education**: Riwayat pendidikan
   - **Experience**: Pengalaman kerja
   - **Order Index**: Urutan tampilan
   - **Is Active**: Aktif/tidak

#### **Contoh Data Guru:**
```
Name: Ahmad Suryadi, S.Pd
Subject: Matematika
Position: Guru Matematika
Type: teacher
Bio: Guru matematika dengan pengalaman 5 tahun mengajar
Education: S1 Pendidikan Matematika
Experience: 5 tahun mengajar di SMP
Order Index: 1
Is Active: ✓
```

### **3. Mengisi Data Pimpinan SMP**

#### **Langkah-langkah:**
1. Klik menu **"Pimpinan SMP"** di sidebar
2. Klik **"Create Pimpinan SMP"**
3. Isi data:
   - **Name**: Nama lengkap pimpinan
   - **Type**: Tulis jabatan sendiri (contoh: "Kepala Sekolah", "Wakil Kepala Sekolah Kurikulum")
   - **Position**: Deskripsi jabatan lengkap
   - **Photo**: Upload foto (opsional)
   - **Bio**: Biografi
   - **Education**: Riwayat pendidikan
   - **Experience**: Pengalaman kerja
   - **Order Index**: Urutan tampilan
   - **Is Active**: Aktif/tidak

#### **Contoh Data Pimpinan:**
```
Name: Dr. Muhammad Rifqi Nugroho, M.Pd
Type: Kepala Sekolah
Position: Kepala Sekolah SMP Muhammadiyah Al Kautsar PK Kartasura
Bio: Kepala sekolah yang visioner dan berdedikasi
Education: S3 Pendidikan
Experience: 10 tahun sebagai kepala sekolah
Order Index: 1
Is Active: ✓
```

### **4. Mengatur Pengaturan Pimpinan SMP**

#### **Langkah-langkah:**
1. Klik menu **"Pengaturan Pimpinan SMP"** di sidebar
2. Klik **"Edit"** data yang ada
3. Isi data:
   - **Title**: Judul halaman (contoh: "Pimpinan SMP")
   - **Subtitle**: Subtitle halaman
   - **Banner Desktop**: Upload banner untuk desktop
   - **Banner Mobile**: Upload banner untuk mobile
   - **Keunggulan Title**: Judul section keunggulan
   - **Keunggulan Subtitle**: Subtitle section keunggulan
   - **Is Active**: Aktif/tidak

#### **Contoh Pengaturan:**
```
Title: Pimpinan SMP
Subtitle: Mengenal para pimpinan SMP Muhammadiyah Al Kautsar PK Kartasura
Keunggulan Title: Keunggulan Kepemimpinan
Keunggulan Subtitle: Keunggulan kepemimpinan yang membedakan kami
Is Active: ✓
```

### **5. Mengisi Box Keunggulan Kepemimpinan**

#### **Langkah-langkah:**
1. Klik menu **"Box Keunggulan Kepemimpinan"** di sidebar
2. Edit setiap box yang ada atau buat yang baru
3. Isi data:
   - **Title**: Judul keunggulan
   - **Description**: Deskripsi keunggulan
   - **Icon**: Emoji atau icon (contoh: 👨‍💼, 🎯, ⭐)
   - **Image**: Upload gambar (opsional)
   - **Background Color**: Pilih warna background
   - **Order Index**: Urutan tampilan
   - **Is Active**: Aktif/tidak

#### **Contoh Box Keunggulan:**
```
Title: Kepemimpinan Visioner
Description: Memiliki visi jangka panjang untuk kemajuan sekolah
Icon: 👨‍💼
Background Color: green-600
Order Index: 1
Is Active: ✓
```

## 🎯 Tips Mengisi Data

### **1. Urutan yang Disarankan:**
1. **Pengaturan Pimpinan SMP** - Set judul dan banner dulu
2. **Pimpinan SMP** - Tambah data pimpinan
3. **Box Keunggulan** - Isi keunggulan kepemimpinan
4. **Guru & Staff** - Tambah data guru dan staff

### **2. Naming Convention:**
- **Guru**: `Nama Lengkap, Gelar` (contoh: "Ahmad Suryadi, S.Pd")
- **Pimpinan**: `Nama Lengkap, Gelar` (contoh: "Dr. Muhammad Rifqi Nugroho, M.Pd")
- **Type Pimpinan**: Tulis natural (contoh: "Kepala Sekolah", "Wakil Kepala Sekolah Kurikulum")

### **3. Foto dan Banner:**
- **Format**: JPG, PNG, WebP
- **Ukuran**: Disarankan tidak terlalu besar (max 2MB)
- **Rasio**: 16:9 untuk banner, 1:1 untuk foto profil

### **4. Backup Rutin:**
```bash
# Backup data setelah selesai mengisi
php artisan data:backup backup
```

## 🔍 Verifikasi Data

### **Cek Data via Command:**
```bash
# Lihat data guru & staff
php artisan teachers:list

# Lihat data pimpinan SMP
php artisan tinker --execute="App\Models\PimpinanSMP::all()->each(function(\$p) { echo \$p->name . ' - ' . \$p->type . PHP_EOL; });"
```

### **Cek Data via API:**
```bash
# Test API guru & staff
curl http://localhost:8000/api/teachers

# Test API pimpinan SMP
curl http://localhost:8000/api/pimpinan-smp/complete
```

## 🚨 Penting!

### **Jangan Lupa:**
1. **Backup data** setelah selesai mengisi
2. **Test API** untuk memastikan data terkirim dengan benar
3. **Verifikasi tampilan** di frontend
4. **Simpan credentials admin** dengan aman

### **Jika Ada Masalah:**
1. **Data tidak tersimpan**: Cek koneksi database
2. **Foto tidak muncul**: Cek storage link
3. **API error**: Cek log Laravel

## 🎉 Selamat Mengisi Data!

Sekarang Anda bisa mengisi data asli guru & staff, pimpinan SMP, dan semua pengaturan sesuai kebutuhan sekolah Anda. Data akan tersimpan dengan aman dan bisa diakses melalui API untuk frontend. 
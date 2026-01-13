# 📚 Update Struktur Navigasi Guru & Staff

## 🔄 **Perubahan Terbaru (Latest Update)**

### **Masalah Sebelumnya:**
- "Pengaturan Halaman Guru" muncul sebagai menu terpisah di sidebar
- Struktur navigasi tidak terorganisir dengan baik
- Frontend sulit memahami hierarki menu

### **Solusi yang Diterapkan:**
- **"Pengaturan Halaman Guru" sekarang menjadi sub-menu dari "Guru & Staff"**
- Struktur navigasi yang lebih terorganisir dan intuitif
- Pemisahan yang jelas antara manajemen data dan pengaturan halaman

---

## 🎯 **Struktur Navigasi Baru**

```
📚 Guru & Staff (Navigation Group)
├── 👥 Daftar Guru & Staff (TeacherResource)
└── ⚙️ Pengaturan Halaman (TeacherSettings)
```

### **Detail Menu:**

#### 1. **👥 Daftar Guru & Staff**
- **File:** `app/Filament/Resources/TeacherResource.php`
- **URL:** `/admin/teachers`
- **Fungsi:** CRUD untuk data guru dan staff
- **Fitur:** 
  - Tambah, edit, hapus guru/staff
  - Upload foto guru
  - Pengaturan status aktif/tidak aktif
  - Pengaturan urutan tampilan

#### 2. **⚙️ Pengaturan Halaman**
- **File:** `app/Filament/Pages/TeacherSettings.php`
- **URL:** `/admin/teacher-settings`
- **Fungsi:** Pengaturan banner, judul, dan informasi halaman guru
- **Fitur:**
  - Pengaturan judul banner
  - Pengaturan subtitle
  - Upload banner desktop & mobile
  - Pengaturan informasi tambahan (tanggal, waktu baca, penulis)

---

## 🔧 **Perubahan Teknis Backend**

### **File yang Dihapus:**
- `app/Filament/Pages/TeacherManagement.php`
- `resources/views/filament/pages/teacher-management.blade.php`

### **File yang Dibuat/Diupdate:**
- `app/Filament/Pages/TeacherSettings.php` (BARU)
- `resources/views/filament/pages/teacher-settings.blade.php` (BARU)
- `app/Filament/Resources/TeacherResource.php` (DIPERBARUI)

### **Perubahan pada TeacherResource:**
```php
// Sebelum
protected static ?string $navigationGroup = 'Profil';
protected static ?string $navigationLabel = 'Guru & Staff';

// Sesudah
protected static ?string $navigationGroup = 'Guru & Staff';
protected static ?string $navigationLabel = 'Daftar Guru & Staff';
```

---

## 📡 **API Endpoints (Tidak Berubah)**

### **1. Data Guru & Staff**
```bash
GET /api/teachers
```

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Nama Guru",
      "position": "Jabatan",
      "subject": "Mata Pelajaran",
      "type": "teacher",
      "photo": "/teachers/foto.jpg",
      "bio": "Biografi guru",
      "education": "Pendidikan terakhir",
      "experience": "Pengalaman",
      "is_active": true,
      "order_index": 1
    }
  ]
}
```

### **2. Pengaturan Halaman Guru**
```bash
GET /api/teacher-settings
```

**Response:**
```json
{
  "success": true,
  "data": {
    "title": "Guru & Staff",
    "subtitle": "Mengenal lebih dekat dengan para pengajar dan staf kami",
    "banner_desktop": "/guru-banners/banner-desktop.jpg",
    "banner_mobile": "/guru-banners/banner-mobile.jpg",
    "date": "Terbaru",
    "read_time": "3 min",
    "author": "Admin"
  }
}
```

---

## 🎨 **Frontend Implementation Guide**

### **1. Struktur Menu di Frontend**
```javascript
// Contoh struktur menu untuk frontend
const teacherMenu = {
  group: "Guru & Staff",
  items: [
    {
      label: "Daftar Guru & Staff",
      icon: "academic-cap",
      url: "/admin/teachers",
      description: "Kelola data guru dan staff"
    },
    {
      label: "Pengaturan Halaman",
      icon: "cog-6-tooth", 
      url: "/admin/teacher-settings",
      description: "Pengaturan banner dan informasi halaman"
    }
  ]
}
```

### **2. Cara Mengakses Data**
```javascript
// Ambil data guru
const teachers = await fetch('/api/teachers').then(r => r.json());

// Ambil pengaturan halaman
const settings = await fetch('/api/teacher-settings').then(r => r.json());

// Gunakan data
const pageTitle = settings.data.title;
const pageSubtitle = settings.data.subtitle;
const bannerDesktop = settings.data.banner_desktop;
```

### **3. Contoh Implementasi React/Vue**
```jsx
// React Component Example
const TeacherPage = () => {
  const [teachers, setTeachers] = useState([]);
  const [settings, setSettings] = useState({});

  useEffect(() => {
    // Load data
    fetchTeachers();
    fetchSettings();
  }, []);

  return (
    <div>
      {/* Banner Section */}
      <Banner 
        title={settings.title}
        subtitle={settings.subtitle}
        bannerDesktop={settings.banner_desktop}
        bannerMobile={settings.banner_mobile}
      />
      
      {/* Teachers List */}
      <TeachersList teachers={teachers} />
    </div>
  );
};
```

---

## 🚀 **Cara Testing**

### **1. Test Backend**
```bash
# Jalankan server
php artisan serve

# Akses admin panel
http://localhost:8000/admin

# Login dan cek menu "Guru & Staff"
```

### **2. Test API**
```bash
# Test API teachers
curl http://localhost:8000/api/teachers

# Test API settings
curl http://localhost:8000/api/teacher-settings
```

### **3. Test Frontend Integration**
```bash
# Pastikan frontend bisa mengakses API
# Cek response format sesuai dokumentasi
# Test loading data dan error handling
```

---

## 📋 **Checklist untuk Frontend**

- [ ] Update struktur menu sesuai navigasi baru
- [ ] Test API endpoints `/api/teachers` dan `/api/teacher-settings`
- [ ] Implementasi loading state untuk data
- [ ] Implementasi error handling
- [ ] Test responsive design untuk banner desktop/mobile
- [ ] Test sorting berdasarkan `order_index`
- [ ] Test filtering berdasarkan `is_active`

---

## 🆘 **Troubleshooting**

### **Jika API tidak berfungsi:**
1. Cek apakah server Laravel berjalan
2. Cek apakah database migration sudah dijalankan
3. Cek log error di `storage/logs/laravel.log`

### **Jika menu tidak muncul:**
1. Clear cache: `php artisan cache:clear`
2. Clear config: `php artisan config:clear`
3. Restart server Laravel

### **Jika data tidak muncul:**
1. Cek apakah ada data di database
2. Cek apakah `guruData->active` sudah diset ke `true`
3. Cek apakah file upload sudah ada di storage

---

## 📞 **Kontak Support**

Jika ada masalah atau pertanyaan:
- **Backend Team:** [Email/Contact]
- **Documentation:** File ini dan `GURU_DATA_SETUP.md`
- **API Testing:** Postman collection tersedia

---

**Last Updated:** $(date)
**Version:** 2.0
**Status:** ✅ Production Ready 
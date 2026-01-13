# 📚 SUMMARY DOKUMENTASI API PROFIL SEKOLAH

## 🎯 **4 SECTION BARU YANG TELAH DIBUAT:**

### **1. 🎯 VISI MISI**
- **File**: `VISI_MISI_API_DOCUMENTATION.md`
- **API Base**: `http://localhost:8000/api/v1/visi-misi`
- **Fitur**: Grid layout fleksibel, list bullet points, background colors
- **Admin Menu**: Profil Sekolah → Visi Misi & Pengaturan Visi Misi

### **2. 🏢 STRUKTUR ORGANISASI**
- **File**: `STRUKTUR_ORGANISASI_API_DOCUMENTATION.md`
- **API Base**: `http://localhost:8000/api/v1/struktur-organisasi`
- **Fitur**: Foto pejabat, jabatan, deskripsi tanggung jawab
- **Admin Menu**: Profil Sekolah → Struktur Organisasi & Pengaturan Struktur Organisasi

### **3. 🕌 IPM (IKATAN PELAJAR MUHAMMADIYAH)**
- **File**: `IPM_API_DOCUMENTATION.md`
- **API Base**: `http://localhost:8000/api/v1/ipm`
- **Fitur**: Data pengurus IPM, foto, kelas, jabatan
- **Admin Menu**: Profil Sekolah → IPM & Pengaturan IPM

### **4. 🎨 EKSTRAKURIKULER**
- **File**: `EKSTRAKURIKULER_API_DOCUMENTATION.md`
- **API Base**: `http://localhost:8000/api/v1/ekstrakurikuler`
- **Fitur**: Kategori, jadwal, lokasi, pembina, filter by category
- **Admin Menu**: Profil Sekolah → Ekstrakurikuler & Pengaturan Ekstrakurikuler

---

## 🔗 **ENDPOINT API PENTING:**

### **🎯 VISI MISI**
```bash
# Semua konten
GET /api/v1/visi-misi

# Pengaturan banner
GET /api/v1/visi-misi/settings

# Data lengkap (banner + konten)
GET /api/v1/visi-misi/complete

# Filter by grid type
GET /api/v1/visi-misi/grid/grid-cols-2

# Konten dengan list bullet
GET /api/v1/visi-misi/with-list-items
```

### **🏢 STRUKTUR ORGANISASI**
```bash
# Semua data pejabat
GET /api/v1/struktur-organisasi

# Pengaturan banner
GET /api/v1/struktur-organisasi/settings

# Data lengkap (banner + pejabat)
GET /api/v1/struktur-organisasi/complete
```

### **🕌 IPM**
```bash
# Semua pengurus IPM
GET /api/v1/ipm

# Pengaturan banner
GET /api/v1/ipm/settings

# Data lengkap (banner + pengurus)
GET /api/v1/ipm/complete
```

### **🎨 EKSTRAKURIKULER**
```bash
# Semua ekstrakurikuler
GET /api/v1/ekstrakurikuler

# Pengaturan banner
GET /api/v1/ekstrakurikuler/settings

# Data lengkap (banner + ekstrakurikuler)
GET /api/v1/ekstrakurikuler/complete

# Filter by kategori
GET /api/v1/ekstrakurikuler/category/Olahraga
```

---

## 🎛️ **ADMIN PANEL ACCESS:**

### **Login Info:**
```
URL: http://localhost:8000/admin
Email: admin@admin.com
Password: admin123
```

### **Menu Structure:**
```
Profil Sekolah
├── Visi Misi
├── Pengaturan Visi Misi
├── Struktur Organisasi
├── Pengaturan Struktur Organisasi
├── IPM
├── Pengaturan IPM
├── Ekstrakurikuler
└── Pengaturan Ekstrakurikuler
```

---

## 📁 **STORAGE FOLDERS:**

```
storage/app/public/
├── visi-misi/           # Banner visi misi
├── struktur-organisasi/ # Foto pejabat
├── ipm/                # Foto pengurus IPM
└── ekstrakurikuler/    # Gambar ekstrakurikuler
```

---

## 🎨 **COLOR THEMES:**

### **Visi Misi:**
- **Panel**: Hijau (`bg-green-500`, `bg-green-700`)
- **Background**: Putih, Biru Muda, Hijau Muda, dll
- **Border**: Abu-abu, Biru, Hijau, dll

### **Struktur Organisasi:**
- **Panel**: Hijau (`bg-green-500`, `bg-green-700`)
- **Theme**: Professional green theme

### **IPM:**
- **Panel**: Merah Gradient (`bg-gradient-to-r from-red-600 to-red-800`)
- **Theme**: Red gradient theme

### **Ekstrakurikuler:**
- **Panel**: Biru Gradient (`bg-gradient-to-r from-blue-600 to-blue-800`)
- **Theme**: Blue gradient theme

---

## 🔧 **FRONTEND INTEGRATION:**

### **React/Next.js Example:**
```javascript
// Get complete data
fetch('http://localhost:8000/api/v1/visi-misi/complete')
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      console.log('Settings:', data.data.settings);
      console.log('Content:', data.data.content);
    }
  });
```

### **Response Format:**
```json
{
  "success": true,
  "data": {
    "settings": {
      "title": "Judul Halaman",
      "subtitle": "Subtitle Halaman",
      "banner_desktop": "http://localhost:8000/storage/...",
      "banner_mobile": "http://localhost:8000/storage/...",
      "title_panel_bg_color": "bg-green-500",
      "subtitle_panel_bg_color": "bg-green-700",
      "mobile_panel_bg_color": "bg-green-700"
    },
    "content": [
      {
        "id": 1,
        "title": "Judul Konten",
        "content": "<p>HTML content...</p>",
        "grid_type": "grid-cols-1",
        "use_list_disc": false,
        "list_items": null,
        "background_color": "bg-white",
        "border_color": "border-gray-200",
        "order_index": 1,
        "is_active": true
      }
    ]
  }
}
```

---

## 🚀 **QUICK START:**

### **1. Test API:**
```bash
# Test semua endpoint
curl http://localhost:8000/api/v1/visi-misi/complete
curl http://localhost:8000/api/v1/struktur-organisasi/complete
curl http://localhost:8000/api/v1/ipm/complete
curl http://localhost:8000/api/v1/ekstrakurikuler/complete
```

### **2. Login Admin:**
```
http://localhost:8000/admin
Email: admin@admin.com
Password: admin123
```

### **3. Tambah Data:**
1. Klik menu sesuai section
2. Klik "Create" untuk tambah data baru
3. Isi form sesuai kebutuhan
4. Upload gambar jika diperlukan
5. Klik "Save"

### **4. Test Frontend:**
- Gunakan endpoint `/complete` untuk mendapatkan data lengkap
- Implementasikan sesuai contoh React/Next.js di dokumentasi masing-masing

---

## 📝 **NOTES PENTING:**

1. **Ordering**: Data diurutkan berdasarkan `order_index` (ascending)
2. **Active Status**: Hanya data dengan `is_active = true` yang dikembalikan
3. **Image URLs**: Semua gambar menggunakan format `http://localhost:8000/storage/{folder}/{filename}`
4. **Responsive Design**: Banner desktop dan mobile terpisah
5. **Grid Layouts**: Visi Misi mendukung `grid-cols-1`, `grid-cols-2`, `grid-cols-3`, `grid-cols-4`
6. **List Items**: Visi Misi mendukung list bullet points dengan `list_items` array
7. **Category Filter**: Ekstrakurikuler mendukung filter by category
8. **Photo Ratio**: Foto pejabat/IPM menggunakan rasio 3:4 (portrait)

---

## 🔍 **TROUBLESHOOTING:**

### **Jika API tidak berfungsi:**
1. Cek apakah server Laravel berjalan: `php artisan serve`
2. Cek apakah migration sudah dijalankan: `php artisan migrate:status`
3. Cek apakah storage link sudah dibuat: `php artisan storage:link`

### **Jika upload gambar gagal:**
1. Cek folder storage permissions
2. Cek apakah folder storage sudah dibuat
3. Cek disk configuration di `config/filesystems.php`

### **Jika admin panel tidak bisa login:**
1. Cek apakah user sudah dibuat
2. Gunakan command: `php artisan admin:create admin@admin.com admin123`

---

**Semua dokumentasi lengkap tersedia di file terpisah untuk masing-masing section!** 📚 
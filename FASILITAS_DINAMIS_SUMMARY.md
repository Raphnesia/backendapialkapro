# 🏫 FASILITAS DINAMIS - SISTEM LENGKAP

## 📋 Overview
Sistem fasilitas dinamis yang memungkinkan pembuatan halaman sub-fasilitas secara otomatis berdasarkan konfigurasi facility box. Sistem ini mendukung struktur yang fleksibel dan dapat dikonfigurasi melalui admin panel.

---

## 🗄️ Database Structure

### **Tabel yang Dibuat:**
1. **`facility_settings`** - Pengaturan halaman fasilitas utama
2. **`facility_boxes`** - 6 box pada halaman fasilitas utama
3. **`sub_facilities`** - Data sub-fasilitas yang dibuat dinamis
4. **`sub_facility_settings`** - Pengaturan setiap sub-fasilitas
5. **`sub_facility_boxes`** - Box-box untuk setiap sub-fasilitas
6. **`sub_facility_photos`** - Foto-foto untuk photo collage sub-fasilitas

### **Relasi Antar Tabel:**
```
facility_boxes.link_slug → sub_facilities.parent_slug
facility_boxes.link_slug → sub_facility_settings.parent_slug
facility_boxes.link_slug → sub_facility_boxes.parent_slug
facility_boxes.link_slug → sub_facility_photos.parent_slug
```

---

## 🎛️ Admin Panel Structure

### **Menu Fasilitas:**
```
Fasilitas
├── Fasilitas (data fasilitas utama)
├── Pengaturan Fasilitas (banner & panel utama)
├── Fasilitas Box (6 box utama)
├── Sub Fasilitas (data sub-fasilitas)
├── Pengaturan Sub Fasilitas (pengaturan sub-fasilitas)
├── Sub Fasilitas Box (box sub-fasilitas)
└── Photo Collage Sub Fasilitas (foto-foto photo collage)
```

### **Workflow Konfigurasi:**

#### **1. Setup Facility Box dengan Sub-Facility**
- Buka **Fasilitas Box**
- Buat box dengan `creates_sub_facility = true`
- Set `link_slug` (contoh: "ruangkelas", "perpustakaan")

#### **2. Setup Sub-Facility Settings**
- Buka **Pengaturan Sub Fasilitas**
- Buat pengaturan dengan `parent_slug` yang sama dengan `link_slug`
- Konfigurasi title, subtitle, banner, content section

#### **3. Setup Sub-Facility Boxes**
- Buka **Sub Fasilitas Box**
- Buat box-box untuk sub-fasilitas dengan `parent_slug` yang sama

#### **4. Setup Sub-Facility Data**
- Buka **Sub Fasilitas**
- Buat data fasilitas dengan `parent_slug` yang sama

---

## 🔗 API Endpoints

### **Main Facility:**
- `GET /api/v1/facilities` - Data lengkap halaman fasilitas
- `GET /api/v1/facilities/settings` - Pengaturan fasilitas
- `GET /api/v1/facilities/boxes` - Box-box fasilitas
- `GET /api/v1/facilities/{slug}` - Single facility

### **Sub-Facilities (Dynamic):**
- `GET /api/v1/facilities/sub/{parentSlug}` - Data sub-fasilitas
- `GET /api/v1/facilities/sub/{parentSlug}/category/{category}` - Filter by category
- `GET /api/v1/facilities/sub/{parentSlug}/{slug}` - Single sub-facility

---

## 🎨 Frontend Integration

### **Main Facility Page:**
```javascript
fetch('http://localhost:8000/api/v1/facilities')
  .then(response => response.json())
  .then(data => {
    const { settings, boxes, facilities } = data.data;
    // Render banner, boxes, dan facilities grid
  });
```

### **Dynamic Sub-Facility Page:**
```javascript
function loadSubFacility(parentSlug) {
     fetch(`http://localhost:8000/api/v1/facilities/sub/${parentSlug}`)
     .then(response => response.json())
     .then(data => {
       const { settings, boxes, photos, facilities } = data.data;
       
       // Render photo collage if enabled
       if (settings.show_photo_collage && photos.length > 0) {
         renderPhotoCollage(photos);
       }
       
       // Render sesuai dengan konfigurasi settings
     });
}

// Contoh penggunaan
loadSubFacility('ruangkelas');     // /fasilitas/ruangkelas
loadSubFacility('perpustakaan');   // /fasilitas/perpustakaan
loadSubFacility('kantin');         // /fasilitas/kantin
```

---

## 📁 File Storage Structure

```
storage/app/public/
├── facilities/
│   ├── banner_desktop.jpg
│   ├── banner_mobile.jpg
│   ├── icons/
│   └── backgrounds/
└── sub-facilities/
    ├── banners/
    ├── icons/
    ├── backgrounds/
    └── facility_images/
```

---

## 🔧 Key Features

### **1. Dynamic Sub-Facilities**
- Sub-fasilitas dibuat otomatis berdasarkan konfigurasi facility box
- Setiap sub-fasilitas memiliki pengaturan independen
- Mendukung berbagai tipe tampilan (grid, list, gallery)

### **2. Flexible Content Management**
- Rich text editor untuk content section
- Photo collage yang dapat diaktifkan/nonaktifkan
- Banner desktop dan mobile terpisah

### **3. Advanced Configuration**
- Warna panel yang dapat disesuaikan
- Urutan tampilan yang dapat diatur
- Status aktif/nonaktif untuk setiap elemen

### **4. SEO-Friendly**
- Slug otomatis menggunakan Spatie Sluggable
- URL yang clean dan descriptive
- Meta data yang dapat dikonfigurasi

---

## 🚀 Implementation Status

### **✅ Completed:**
- [x] Database migrations
- [x] Model relationships
- [x] API controllers
- [x] Filament resources
- [x] Admin panel forms
- [x] Data seeding
- [x] API testing
- [x] Documentation

### **📋 Ready for Frontend:**
- [x] API endpoints working
- [x] Data structure defined
- [x] File upload system
- [x] Error handling
- [x] Response formatting

---

## 🎯 Example Usage

### **Scenario: Membuat Halaman Ruang Kelas**

1. **Admin Panel Setup:**
   ```
   Facility Box: "Ruang Kelas" → link_slug: "ruangkelas"
   Sub-Facility Settings: parent_slug: "ruangkelas"
   Sub-Facility Boxes: 3 boxes dengan parent_slug: "ruangkelas"
   Sub-Facilities: 3 ruang kelas dengan parent_slug: "ruangkelas"
   ```

2. **Frontend Access:**
   ```
   URL: /fasilitas/ruangkelas
   API: /api/v1/facilities/sub/ruangkelas
   ```

3. **Result:**
   - Halaman dengan banner custom
   - Content section dengan rich text
   - Photo collage
   - 3 box informasi
   - Grid fasilitas ruang kelas

---

## 📝 Notes

1. **Scalability**: Sistem dapat menangani unlimited sub-facilities
2. **Maintainability**: Konfigurasi terpusat di admin panel
3. **Flexibility**: Setiap sub-facility dapat memiliki konfigurasi berbeda
4. **Performance**: Query optimization dengan proper indexing
5. **Security**: File upload validation dan sanitization

---

## 🔗 Related Files

### **Migrations:**
- `2025_08_04_120000_create_facility_settings_table.php`
- `2025_08_04_120100_create_facility_boxes_table.php`
- `2025_08_04_120200_create_sub_facilities_table.php`
- `2025_08_04_120300_create_sub_facility_settings_table.php`
- `2025_08_04_120400_create_sub_facility_boxes_table.php`

### **Models:**
- `FacilitySettings.php`
- `FacilityBox.php`
- `SubFacility.php`
- `SubFacilitySettings.php`
- `SubFacilityBox.php`
- `SubFacilityPhoto.php`

### **Controllers:**
- `FacilityController.php` (updated)

### **Filament Resources:**
- `FacilitySettingsResource.php`
- `FacilityBoxResource.php`
- `SubFacilityResource.php`
- `SubFacilitySettingsResource.php`
- `SubFacilityBoxResource.php`
- `SubFacilityPhotoResource.php`

### **Documentation:**
- `FASILITAS_DINAMIS_API_DOCUMENTATION.md`
- `test_fasilitas_dinamis.php`

---

**🎉 Sistem Fasilitas Dinamis selesai dan siap digunakan!** 🏫 
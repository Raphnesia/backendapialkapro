# 📚 Dokumentasi API Profil Sekolah

## 🎯 Overview

Dokumentasi API untuk 4 section baru di Profil Sekolah:
1. **Visi Misi** - Mengelola konten visi, misi, dan tujuan sekolah
2. **Struktur Organisasi** - Mengelola struktur organisasi sekolah
3. **IPM (Ikatan Pelajar Muhammadiyah)** - Mengelola data pengurus IPM
4. **Ekstrakurikuler** - Mengelola data ekstrakurikuler sekolah

## 🔗 Base URL

```
http://localhost:8000/api/v1
```

---

## 📋 1. VISI MISI API

### **1.1 Get All Visi Misi Content**
```http
GET /visi-misi
```

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "title": "Visi Sekolah",
      "content": "<p>Menjadi lembaga pendidikan Islam yang unggul...</p>",
      "grid_type": "grid-cols-1",
      "use_list_disc": false,
      "list_items": null,
      "background_color": "bg-white",
      "border_color": "border-gray-200",
      "order_index": 1,
      "is_active": true,
      "created_at": "2025-08-04T12:00:00.000000Z",
      "updated_at": "2025-08-04T12:00:00.000000Z"
    }
  ]
}
```

### **1.2 Get Single Visi Misi Content**
```http
GET /visi-misi/{id}
```

### **1.3 Get Visi Misi Settings**
```http
GET /visi-misi/settings
```

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "title": "Visi & Misi SMP Muhammadiyah Al Kautsar PK Kartasura",
    "subtitle": "Arah dan tujuan pendidikan Islam berkualitas",
    "banner_desktop": "http://localhost:8000/storage/visi-misi/banner_desktop.jpg",
    "banner_mobile": "http://localhost:8000/storage/visi-misi/banner_mobile.jpg",
    "title_panel_bg_color": "bg-green-500",
    "subtitle_panel_bg_color": "bg-green-700",
    "mobile_panel_bg_color": "bg-green-700",
    "is_active": true
  }
}
```

### **1.4 Get Complete Visi Misi Data**
```http
GET /visi-misi/complete
```

**Response:**
```json
{
  "success": true,
  "data": {
    "settings": {
      "id": 1,
      "title": "Visi & Misi SMP Muhammadiyah Al Kautsar PK Kartasura",
      "subtitle": "Arah dan tujuan pendidikan Islam berkualitas",
      "banner_desktop": "http://localhost:8000/storage/visi-misi/banner_desktop.jpg",
      "banner_mobile": "http://localhost:8000/storage/visi-misi/banner_mobile.jpg",
      "title_panel_bg_color": "bg-green-500",
      "subtitle_panel_bg_color": "bg-green-700",
      "mobile_panel_bg_color": "bg-green-700",
      "is_active": true
    },
    "content": [
      {
        "id": 1,
        "title": "Visi Sekolah",
        "content": "<p>Menjadi lembaga pendidikan Islam yang unggul...</p>",
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

### **1.5 Get Content by Grid Type**
```http
GET /visi-misi/grid/{gridType}
```

**Grid Types:**
- `grid-cols-1` - Grid 1 Kolom
- `grid-cols-2` - Grid 2 Kolom
- `grid-cols-3` - Grid 3 Kolom
- `grid-cols-4` - Grid 4 Kolom

### **1.6 Get Content with List Items**
```http
GET /visi-misi/with-list-items
```

---

## 🏢 2. STRUKTUR ORGANISASI API

### **2.1 Get All Struktur Organisasi**
```http
GET /struktur-organisasi
```

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "position": "Kepala Sekolah",
      "name": "Drs. Mahmud Hasni, M.Pd.",
      "photo": "http://localhost:8000/storage/struktur-organisasi/photo.jpg",
      "description": "Bertanggung jawab atas keseluruhan pengelolaan dan pengembangan sekolah.",
      "order_index": 1,
      "is_active": true,
      "created_at": "2025-08-04T12:00:00.000000Z",
      "updated_at": "2025-08-04T12:00:00.000000Z"
    }
  ]
}
```

### **2.2 Get Single Struktur Organisasi**
```http
GET /struktur-organisasi/{id}
```

### **2.3 Get Struktur Organisasi Settings**
```http
GET /struktur-organisasi/settings
```

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "title": "Struktur Organisasi SMP Muhammadiyah Al Kautsar PK Kartasura",
    "subtitle": "Susunan organisasi pengelolaan sekolah yang efektif",
    "banner_desktop": "http://localhost:8000/storage/struktur-organisasi/banner_desktop.jpg",
    "banner_mobile": "http://localhost:8000/storage/struktur-organisasi/banner_mobile.jpg",
    "title_panel_bg_color": "bg-green-500",
    "subtitle_panel_bg_color": "bg-green-700",
    "mobile_panel_bg_color": "bg-green-700",
    "is_active": true
  }
}
```

### **2.4 Get Complete Struktur Organisasi Data**
```http
GET /struktur-organisasi/complete
```

---

## 🕌 3. IPM (IKATAN PELAJAR MUHAMMADIYAH) API

### **3.1 Get All IPM Data**
```http
GET /ipm
```

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "position": "Ketua IPM",
      "name": "Ahmad Fauzan",
      "photo": "http://localhost:8000/storage/ipm/photo.jpg",
      "kelas": "IX A",
      "description": "Ketua IPM SMP Muhammadiyah Al Kautsar PK Kartasura",
      "order_index": 1,
      "is_active": true,
      "created_at": "2025-08-04T12:00:00.000000Z",
      "updated_at": "2025-08-04T12:00:00.000000Z"
    }
  ]
}
```

### **3.2 Get Single IPM Data**
```http
GET /ipm/{id}
```

### **3.3 Get IPM Settings**
```http
GET /ipm/settings
```

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "title": "Ikatan Pelajar Muhammadiyah (IPM)",
    "subtitle": "Organisasi pelajar berbasis nilai Islam dan Kemuhammadiyahan",
    "banner_desktop": "http://localhost:8000/storage/ipm/banner_desktop.jpg",
    "banner_mobile": "http://localhost:8000/storage/ipm/banner_mobile.jpg",
    "title_panel_bg_color": "bg-gradient-to-r from-red-600 to-red-800",
    "subtitle_panel_bg_color": "bg-gradient-to-r from-red-700 to-red-900",
    "mobile_panel_bg_color": "bg-gradient-to-r from-red-700 to-red-800",
    "is_active": true
  }
}
```

### **3.4 Get Complete IPM Data**
```http
GET /ipm/complete
```

---

## 🎨 4. EKSTRAKURIKULER API

### **4.1 Get All Ekstrakurikuler**
```http
GET /ekstrakurikuler
```

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "title": "Sepak Bola",
      "excerpt": "Ekstrakurikuler sepak bola untuk mengembangkan kemampuan olahraga dan kerjasama tim.",
      "image": "http://localhost:8000/storage/ekstrakurikuler/image.jpg",
      "category": "Olahraga",
      "jadwal": "Jumat 13.00-15.00",
      "location": "Lapangan Sekolah",
      "pembina": "Pak Ahmad",
      "description": "<p>Deskripsi lengkap ekstrakurikuler sepak bola...</p>",
      "order_index": 1,
      "is_active": true,
      "created_at": "2025-08-04T12:00:00.000000Z",
      "updated_at": "2025-08-04T12:00:00.000000Z"
    }
  ]
}
```

### **4.2 Get Single Ekstrakurikuler**
```http
GET /ekstrakurikuler/{id}
```

### **4.3 Get Ekstrakurikuler Settings**
```http
GET /ekstrakurikuler/settings
```

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "title": "Ekstrakurikuler",
    "subtitle": "Temukan minat dan bakatmu melalui berbagai kegiatan ekstrakurikuler",
    "banner_desktop": "http://localhost:8000/storage/ekstrakurikuler/banner_desktop.jpg",
    "banner_mobile": "http://localhost:8000/storage/ekstrakurikuler/banner_mobile.jpg",
    "title_panel_bg_color": "bg-gradient-to-r from-blue-600 to-blue-800",
    "subtitle_panel_bg_color": "bg-gradient-to-r from-blue-700 to-blue-900",
    "mobile_panel_bg_color": "bg-gradient-to-r from-blue-700 to-blue-800",
    "is_active": true
  }
}
```

### **4.4 Get Complete Ekstrakurikuler Data**
```http
GET /ekstrakurikuler/complete
```

### **4.5 Get Ekstrakurikuler by Category**
```http
GET /ekstrakurikuler/category/{category}
```

**Categories:**
- `Olahraga`
- `Seni Budaya`
- `Teknologi`
- `Semua Ekstrakurikuler` (untuk mendapatkan semua kategori)

---

## 🎨 Data Structure Details

### **Grid Types (Visi Misi)**
- `grid-cols-1` - Layout 1 kolom
- `grid-cols-2` - Layout 2 kolom
- `grid-cols-3` - Layout 3 kolom
- `grid-cols-4` - Layout 4 kolom

### **Background Colors**
- `bg-white` - Putih
- `bg-gray-50` - Abu-abu Muda
- `bg-blue-50` - Biru Muda
- `bg-green-50` - Hijau Muda
- `bg-yellow-50` - Kuning Muda
- `bg-purple-50` - Ungu Muda
- `bg-red-50` - Merah Muda

### **Border Colors**
- `border-gray-200` - Abu-abu
- `border-blue-200` - Biru
- `border-green-200` - Hijau
- `border-yellow-200` - Kuning
- `border-purple-200` - Ungu
- `border-red-200` - Merah
- `border-transparent` - Transparan

### **Panel Colors**
- `bg-green-500` - Hijau
- `bg-blue-500` - Biru
- `bg-red-500` - Merah
- `bg-yellow-500` - Kuning
- `bg-purple-500` - Ungu
- `bg-gray-500` - Abu-abu

### **Gradient Colors (IPM & Ekstrakurikuler)**
- `bg-gradient-to-r from-red-600 to-red-800` - Merah gradient
- `bg-gradient-to-r from-blue-600 to-blue-800` - Biru gradient

---

## 🔧 Frontend Integration Examples

### **React/Next.js Example - Visi Misi**
```javascript
import { useState, useEffect } from 'react';

function VisiMisiPage() {
  const [data, setData] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetch('http://localhost:8000/api/v1/visi-misi/complete')
      .then(response => response.json())
      .then(result => {
        if (result.success) {
          setData(result.data);
        }
        setLoading(false);
      });
  }, []);

  if (loading) return <div>Loading...</div>;
  if (!data) return <div>No data</div>;

  return (
    <div>
      {/* Banner Section */}
      <div className="relative w-full md:h-screen h-64">
        <img 
          src={data.settings.banner_desktop} 
          alt="banner"
          className="object-cover hidden md:block"
        />
        <img 
          src={data.settings.banner_mobile} 
          alt="banner"
          className="object-cover md:hidden"
        />
        
        {/* Title Panel */}
        <div className={`absolute bottom-0 ${data.settings.title_panel_bg_color} p-5`}>
          <h1 className="text-white font-bold">{data.settings.title}</h1>
        </div>
        
        {/* Subtitle Panel */}
        <div className={`absolute bottom-0 ${data.settings.subtitle_panel_bg_color} p-4`}>
          <p className="text-white">{data.settings.subtitle}</p>
        </div>
      </div>

      {/* Content Sections */}
      <div className="container mx-auto px-4 py-8">
        {data.content.map((section, index) => (
          <div key={index} className={`${section.background_color} ${section.border_color} rounded-lg p-6 mb-8`}>
            <h2 className="text-2xl font-semibold mb-4">{section.title}</h2>
            <div className={`grid ${section.grid_type} gap-6`}>
              <div dangerouslySetInnerHTML={{ __html: section.content }} />
              {section.use_list_disc && section.list_items && (
                <ul className="list-disc pl-5">
                  {section.list_items.map((item, idx) => (
                    <li key={idx}>{item.item}</li>
                  ))}
                </ul>
              )}
            </div>
          </div>
        ))}
      </div>
    </div>
  );
}
```

### **React/Next.js Example - Struktur Organisasi**
```javascript
function StrukturOrganisasiPage() {
  const [data, setData] = useState(null);

  useEffect(() => {
    fetch('http://localhost:8000/api/v1/struktur-organisasi/complete')
      .then(response => response.json())
      .then(result => {
        if (result.success) {
          setData(result.data);
        }
      });
  }, []);

  return (
    <div>
      {/* Banner Section */}
      <div className="relative w-full md:h-screen h-64">
        <img 
          src={data.settings.banner_desktop} 
          alt="banner"
          className="object-cover hidden md:block"
        />
        <img 
          src={data.settings.banner_mobile} 
          alt="banner"
          className="object-cover md:hidden"
        />
        
        <div className={`absolute bottom-0 ${data.settings.title_panel_bg_color} p-5`}>
          <h1 className="text-white font-bold">{data.settings.title}</h1>
        </div>
      </div>

      {/* Struktur Organisasi Cards */}
      <div className="container mx-auto px-4 py-8">
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          {data.content.map((item, index) => (
            <div key={index} className="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-md">
              <div className="relative h-64 overflow-hidden bg-gray-100">
                <img 
                  src={item.photo} 
                  alt={item.name}
                  className="w-full h-full object-cover object-center"
                />
              </div>
              <div className="p-4">
                <h4 className="text-lg font-semibold text-primary mb-1">{item.position}</h4>
                <p className="text-gray-800 font-medium mb-2">{item.name}</p>
                <p className="text-gray-600 text-sm">{item.description}</p>
              </div>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
}
```

### **React/Next.js Example - IPM**
```javascript
function IPMPage() {
  const [data, setData] = useState(null);

  useEffect(() => {
    fetch('http://localhost:8000/api/v1/ipm/complete')
      .then(response => response.json())
      .then(result => {
        if (result.success) {
          setData(result.data);
        }
      });
  }, []);

  return (
    <div>
      {/* Banner Section */}
      <div className="relative w-full md:h-screen h-64">
        <img 
          src={data.settings.banner_desktop} 
          alt="banner"
          className="object-cover hidden md:block"
        />
        <img 
          src={data.settings.banner_mobile} 
          alt="banner"
          className="object-cover md:hidden"
        />
        
        <div className={`absolute bottom-0 ${data.settings.title_panel_bg_color} p-5`}>
          <h1 className="text-white font-bold">{data.settings.title}</h1>
        </div>
      </div>

      {/* IPM Pengurus */}
      <div className="container mx-auto px-4 py-8">
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          {data.content.map((item, index) => (
            <div key={index} className="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-md">
              <div className="relative h-64 overflow-hidden bg-gray-100">
                <img 
                  src={item.photo} 
                  alt={item.name}
                  className="w-full h-full object-cover object-center"
                />
              </div>
              <div className="p-4">
                <h4 className="text-lg font-semibold text-primary mb-1">{item.position}</h4>
                <p className="text-gray-800 font-medium mb-2">{item.name}</p>
                <p className="text-gray-600 text-sm">Kelas: {item.kelas}</p>
                {item.description && (
                  <p className="text-gray-600 text-sm mt-2">{item.description}</p>
                )}
              </div>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
}
```

### **React/Next.js Example - Ekstrakurikuler**
```javascript
function EkstrakurikulerPage() {
  const [data, setData] = useState(null);
  const [selectedCategory, setSelectedCategory] = useState('Semua Ekstrakurikuler');

  useEffect(() => {
    fetch('http://localhost:8000/api/v1/ekstrakurikuler/complete')
      .then(response => response.json())
      .then(result => {
        if (result.success) {
          setData(result.data);
        }
      });
  }, []);

  const handleCategoryChange = (category) => {
    setSelectedCategory(category);
    if (category === 'Semua Ekstrakurikuler') {
      fetch('http://localhost:8000/api/v1/ekstrakurikuler')
        .then(response => response.json())
        .then(result => {
          if (result.success) {
            setData({ ...data, content: result.data });
          }
        });
    } else {
      fetch(`http://localhost:8000/api/v1/ekstrakurikuler/category/${category}`)
        .then(response => response.json())
        .then(result => {
          if (result.success) {
            setData({ ...data, content: result.data });
          }
        });
    }
  };

  return (
    <div>
      {/* Banner Section */}
      <div className="relative w-full md:h-screen h-64">
        <img 
          src={data.settings.banner_desktop} 
          alt="banner"
          className="object-cover hidden md:block"
        />
        <img 
          src={data.settings.banner_mobile} 
          alt="banner"
          className="object-cover md:hidden"
        />
        
        <div className={`absolute bottom-0 ${data.settings.title_panel_bg_color} p-5`}>
          <h1 className="text-white font-bold">{data.settings.title}</h1>
        </div>
      </div>

      {/* Category Filter */}
      <div className="container mx-auto px-4 py-8">
        <div className="flex flex-wrap gap-2 justify-center mb-8">
          {['Semua Ekstrakurikuler', 'Olahraga', 'Seni Budaya', 'Teknologi'].map((category) => (
            <button
              key={category}
              onClick={() => handleCategoryChange(category)}
              className={`px-5 py-2.5 rounded-full font-medium ${
                selectedCategory === category
                  ? 'bg-blue-600 text-white'
                  : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
              }`}
            >
              {category}
            </button>
          ))}
        </div>

        {/* Ekstrakurikuler Cards */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          {data.content.map((item, index) => (
            <div key={index} className="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-md">
              <div className="relative h-32 overflow-hidden">
                <img 
                  src={item.image} 
                  alt={item.title}
                  className="w-full h-full object-cover"
                />
              </div>
              <div className="p-4">
                <h3 className="text-lg font-semibold text-gray-800 mb-2">{item.title}</h3>
                <p className="text-gray-600 text-sm mb-3">{item.excerpt}</p>
                <div className="space-y-1">
                  <div className="flex items-center text-xs text-gray-500">
                    <span>🕒 {item.jadwal}</span>
                  </div>
                  <div className="flex items-center text-xs text-gray-500">
                    <span>📍 {item.location}</span>
                  </div>
                  <div className="flex items-center text-xs text-gray-500">
                    <span>👨‍🏫 {item.pembina}</span>
                  </div>
                </div>
              </div>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
}
```

---

## 🚀 Error Handling

### **Standard Error Response**
```json
{
  "success": false,
  "message": "Error description"
}
```

### **Common HTTP Status Codes**
- `200` - Success
- `404` - Data not found
- `500` - Server error

---

## 📝 Notes

1. **File Uploads**: Semua gambar disimpan di `storage/app/public/` dengan struktur folder:
   - `visi-misi/` - Banner visi misi
   - `struktur-organisasi/` - Foto struktur organisasi
   - `ipm/` - Foto pengurus IPM
   - `ekstrakurikuler/` - Gambar ekstrakurikuler

2. **Image URLs**: Semua URL gambar menggunakan format:
   ```
   http://localhost:8000/storage/{folder}/{filename}
   ```

3. **Ordering**: Data diurutkan berdasarkan `order_index` (ascending)

4. **Active Status**: Hanya data dengan `is_active = true` yang dikembalikan

5. **Grid Layouts**: Untuk Visi Misi, gunakan `grid_type` untuk mengatur layout:
   - `grid-cols-1` untuk layout 1 kolom
   - `grid-cols-2` untuk layout 2 kolom
   - dst.

6. **List Items**: Untuk konten dengan bullet points, gunakan `use_list_disc = true` dan isi `list_items` array

---

## 🔧 Admin Panel Access

Semua data dapat dikelola melalui admin panel Filament di:
```
http://localhost:8000/admin
```

**Menu Structure:**
- **Profil Sekolah**
  - Visi Misi
  - Pengaturan Visi Misi
  - Struktur Organisasi
  - Pengaturan Struktur Organisasi
  - IPM
  - Pengaturan IPM
  - Ekstrakurikuler
  - Pengaturan Ekstrakurikuler

---

**Dokumentasi ini mencakup semua endpoint API untuk 4 section baru di Profil Sekolah!** 🎉 
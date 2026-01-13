# 🕌 IPM UPDATE DOCUMENTATION

## 📋 Overview
IPM sekarang memiliki 3 bagian terpisah seperti Visi Misi:

1. **IPM Content** - Konten seperti Visi Misi (grid layout, list bullet)
2. **IPM Pengurus** - Data pengurus IPM (foto, jabatan, kelas)
3. **Pengaturan IPM** - Banner, title, subtitle

## 🔗 Base URL
```
http://localhost:8000/api/v1/ipm
http://localhost:8000/api/v1/ipm-content
```

---

## 📡 API Endpoints

### **1. IPM Content (Konten seperti Visi Misi)**
```http
GET /ipm-content
GET /ipm-content/{id}
GET /ipm-content/grid/{gridType}
GET /ipm-content/with-list-items
```

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "title": "Visi IPM",
      "content": "<p>Menjadi organisasi pelajar yang unggul dalam membentuk generasi beriman, berilmu, berakhlak mulia.</p>",
      "grid_type": "grid-cols-1",
      "use_list_disc": false,
      "list_items": null,
      "background_color": "bg-white",
      "border_color": "border-gray-200",
      "order_index": 1,
      "is_active": true
    },
    {
      "id": 2,
      "title": "Misi IPM",
      "content": "<p>Misi IPM untuk mencapai visi yang telah ditetapkan.</p>",
      "grid_type": "grid-cols-2",
      "use_list_disc": true,
      "list_items": [
        {"item": "Menyelenggarakan kegiatan keagamaan"},
        {"item": "Mengembangkan bakat dan minat pelajar"},
        {"item": "Membina kerjasama antar pelajar"}
      ],
      "background_color": "bg-red-50",
      "border_color": "border-red-200",
      "order_index": 2,
      "is_active": true
    }
  ]
}
```

### **2. IPM Pengurus (Data Pengurus)**
```http
GET /ipm
GET /ipm/{id}
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
      "photo": "http://localhost:8000/storage/ipm/ketua_ipm.jpg",
      "kelas": "IX A",
      "description": "Ketua IPM SMP Muhammadiyah Al Kautsar PK Kartasura",
      "order_index": 1,
      "is_active": true
    }
  ]
}
```

### **3. Pengaturan IPM (Banner & Panel)**
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

### **4. Complete IPM Data (Semua Data)**
```http
GET /ipm/complete
```

**Response:**
```json
{
  "success": true,
  "data": {
    "settings": {
      "id": 1,
      "title": "Ikatan Pelajar Muhammadiyah (IPM)",
      "subtitle": "Organisasi pelajar berbasis nilai Islam dan Kemuhammadiyahan",
      "banner_desktop": "http://localhost:8000/storage/ipm/banner_desktop.jpg",
      "banner_mobile": "http://localhost:8000/storage/ipm/banner_mobile.jpg",
      "title_panel_bg_color": "bg-gradient-to-r from-red-600 to-red-800",
      "subtitle_panel_bg_color": "bg-gradient-to-r from-red-700 to-red-900",
      "mobile_panel_bg_color": "bg-gradient-to-r from-red-700 to-red-800",
      "is_active": true
    },
    "pengurus": [
      {
        "id": 1,
        "position": "Ketua IPM",
        "name": "Ahmad Fauzan",
        "photo": "http://localhost:8000/storage/ipm/ketua_ipm.jpg",
        "kelas": "IX A",
        "description": "Ketua IPM SMP Muhammadiyah Al Kautsar PK Kartasura",
        "order_index": 1,
        "is_active": true
      }
    ],
    "content": [
      {
        "id": 1,
        "title": "Visi IPM",
        "content": "<p>Menjadi organisasi pelajar yang unggul...</p>",
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

## 🎛️ Admin Panel Menu Structure

```
Profil Sekolah
├── Visi Misi
├── Pengaturan Visi Misi
├── Struktur Organisasi
├── Pengaturan Struktur Organisasi
├── IPM Content          ← BARU!
├── IPM Pengurus         ← RENAME!
├── Pengaturan IPM
├── Ekstrakurikuler
└── Pengaturan Ekstrakurikuler
```

---

## 🔧 Form Fields Description

### **IPM Content:**
- **Judul Section**: Judul konten (contoh: "Visi IPM", "Misi IPM")
- **Konten**: Rich text editor untuk konten HTML
- **Tipe Grid Layout**: Pilihan layout (1-4 kolom)
- **Gunakan List Bullet**: Toggle untuk mengaktifkan list bullet
- **Item List**: Repeater field untuk list items (muncul jika list bullet aktif)
- **Warna Background**: Pilihan warna background section
- **Warna Border**: Pilihan warna border section
- **Urutan**: Angka untuk mengatur urutan tampilan
- **Aktif**: Toggle untuk menampilkan/menyembunyikan

### **IPM Pengurus:**
- **Jabatan**: Posisi dalam organisasi IPM
- **Nama**: Nama lengkap pengurus
- **Foto**: Upload foto pengurus (rasio 3:4)
- **Kelas**: Kelas pengurus (contoh: "IX A", "VIII B")
- **Deskripsi**: Deskripsi jabatan (opsional)
- **Urutan**: Angka untuk mengatur urutan tampilan
- **Aktif**: Toggle untuk menampilkan/menyembunyikan

### **Pengaturan IPM:**
- **Judul Halaman**: Judul utama halaman
- **Subtitle**: Subtitle halaman
- **Banner Desktop**: Upload gambar banner desktop (16:9 ratio)
- **Banner Mobile**: Upload gambar banner mobile (16:9 ratio)
- **Warna Background Title Panel**: Warna gradient panel judul
- **Warna Background Subtitle Panel**: Warna gradient panel subtitle
- **Warna Background Mobile Panel**: Warna gradient panel mobile
- **Aktif**: Toggle untuk menampilkan/menyembunyikan

---

## 🎨 Frontend Integration Example

### **React/Next.js Implementation**
```javascript
import { useState, useEffect } from 'react';

function IPMPage() {
  const [data, setData] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetch('http://localhost:8000/api/v1/ipm/complete')
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
    <div className="min-h-screen flex flex-col">
      {/* Banner Section */}
      <div className="relative w-full md:h-screen h-64">
        {/* Desktop Banner */}
        <img 
          src={data.settings.banner_desktop} 
          alt="banner"
          className="object-cover hidden md:block w-full h-full"
        />
        
        {/* Mobile Banner */}
        <img 
          src={data.settings.banner_mobile} 
          alt="banner"
          className="object-cover md:hidden w-full h-full"
        />
        
        {/* Overlay Content untuk Desktop */}
        <div className="absolute inset-0 hidden md:flex md:items-end">
          <div className="w-full bg-gradient-to-t from-red-900/80 via-red-800/40 to-transparent">
            <div className="container mx-auto px-8 pb-16">
              <div className="max-w-3xl">
                {/* Title Panel */}
                <div className="block">
                  <div className={`${data.settings.title_panel_bg_color} inline-flex p-5`}>
                    <h1 className="text-2xl md:text-3xl lg:text-2xl font-bold text-white mb-0">
                      {data.settings.title}
                    </h1>
                  </div>
                </div>
                
                {/* Subtitle Panel */}
                <div className={`${data.settings.subtitle_panel_bg_color} p-4 opacity-90 inline-flex rounded-b-lg`}>
                  <p className="text-white text-sm md:text-lg font-semibold mb-0">
                    {data.settings.subtitle}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      {/* Mobile Title Panel */}
      <div className="w-full bg-gradient-to-r from-red-600 to-red-900 py-4 md:hidden">
        <div className="container mx-auto px-4">
          <div className="block">
            <div className={`${data.settings.mobile_panel_bg_color} inline-flex p-3`}>
              <h1 className="text-lg font-bold text-white mb-0">
                {data.settings.title}
              </h1>
            </div>
          </div>
        </div>
      </div>

      {/* IPM Content Sections */}
      <main className="flex-grow container mx-auto px-4 py-8 bg-white">
        <div className="prose prose-black max-w-none">
          {data.content.map((section, index) => (
            <div key={index} className={`${section.background_color} ${section.border_color} rounded-lg shadow-md p-6 mb-8`}>
              <div className="flex items-center justify-center mb-6">
                <div className="w-16 h-1 bg-primary rounded-full mr-3"></div>
                <h2 className="text-2xl font-semibold text-primary">{section.title}</h2>
                <div className="w-16 h-1 bg-primary rounded-full ml-3"></div>
              </div>
              
              <div className={`grid ${section.grid_type} gap-6`}>
                <div className="text-black" dangerouslySetInnerHTML={{ __html: section.content }} />
                
                {section.use_list_disc && section.list_items && (
                  <div className="space-y-3">
                    {section.list_items.map((item, idx) => (
                      <div key={idx} className="bg-white p-3 rounded-lg border border-gray-200 shadow-sm">
                        <p className="text-black font-medium">{item.item}</p>
                      </div>
                    ))}
                  </div>
                )}
              </div>
            </div>
          ))}
        </div>

        {/* IPM Pengurus Section */}
        <div className="mt-12">
          <h2 className="text-3xl font-bold text-primary mb-8 text-center">Pengurus IPM</h2>
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {data.pengurus.map((pengurus, index) => (
              <div key={index} className="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow">
                <div className="relative h-64 overflow-hidden bg-gray-100">
                  <img 
                    src={pengurus.photo} 
                    alt={pengurus.name}
                    className="w-full h-full object-cover object-center"
                  />
                </div>
                <div className="p-4">
                  <h4 className="text-lg font-semibold text-primary mb-1">{pengurus.position}</h4>
                  <p className="text-gray-800 font-medium mb-2">{pengurus.name}</p>
                  <p className="text-gray-600 text-sm mb-2">Kelas: {pengurus.kelas}</p>
                  <p className="text-gray-600 text-sm">{pengurus.description}</p>
                </div>
              </div>
            ))}
          </div>
        </div>
      </main>
    </div>
  );
}

export default IPMPage;
```

---

## 🚀 Quick Start

### **1. Test API:**
```bash
# Test IPM Content
curl http://localhost:8000/api/v1/ipm-content

# Test IPM Pengurus
curl http://localhost:8000/api/v1/ipm

# Test Complete Data
curl http://localhost:8000/api/v1/ipm/complete
```

### **2. Login Admin:**
```
URL: http://localhost:8000/admin
Email: admin@admin.com
Password: admin123
```

### **3. Tambah Data:**
1. **IPM Content**: Klik "IPM Content" → "Create" → Isi form konten
2. **IPM Pengurus**: Klik "IPM Pengurus" → "Create" → Isi form pengurus
3. **Pengaturan IPM**: Klik "Pengaturan IPM" → "Create" → Isi form settings

---

## 📝 Notes

1. **IPM Content**: Mendukung grid layout dan list bullet seperti Visi Misi
2. **IPM Pengurus**: Data pengurus dengan foto dan informasi kelas
3. **Pengaturan IPM**: Banner dan panel settings dengan gradient merah
4. **Complete Data**: Endpoint `/ipm/complete` mengembalikan semua data sekaligus
5. **Ordering**: Semua data diurutkan berdasarkan `order_index` (ascending)
6. **Active Status**: Hanya data dengan `is_active = true` yang dikembalikan

---

**Struktur IPM sekarang sudah lengkap dengan 3 bagian terpisah!** 🕌 
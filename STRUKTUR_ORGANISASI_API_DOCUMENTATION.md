# 🏢 STRUKTUR ORGANISASI API DOCUMENTATION

## 📋 Overview
API untuk mengelola struktur organisasi sekolah dengan data jabatan, nama, foto, dan deskripsi tanggung jawab.

## 🔗 Base URL
```
http://localhost:8000/api/v1/struktur-organisasi
```

---

## 📡 API Endpoints

### **1. Get All Struktur Organisasi**
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
      "photo": "http://localhost:8000/storage/struktur-organisasi/kepala_sekolah.jpg",
      "description": "Bertanggung jawab atas keseluruhan pengelolaan dan pengembangan sekolah.",
      "order_index": 1,
      "is_active": true,
      "created_at": "2025-08-04T12:00:00.000000Z",
      "updated_at": "2025-08-04T12:00:00.000000Z"
    },
    {
      "id": 2,
      "position": "Wakil Kepala Sekolah Bidang Kurikulum",
      "name": "Annisa Mayasari, S.Pd.",
      "photo": "http://localhost:8000/storage/struktur-organisasi/waka_kurikulum.jpg",
      "description": "Bertanggung jawab dalam pengembangan dan implementasi kurikulum sekolah.",
      "order_index": 2,
      "is_active": true,
      "created_at": "2025-08-04T12:00:00.000000Z",
      "updated_at": "2025-08-04T12:00:00.000000Z"
    },
    {
      "id": 3,
      "position": "Wakil Kepala Sekolah Bidang Kesiswaan",
      "name": "Ardiansyah Pratama Putra, S.Sn.",
      "photo": "http://localhost:8000/storage/struktur-organisasi/waka_kesiswaan.jpg",
      "description": "Bertanggung jawab dalam pembinaan dan pengembangan kegiatan kesiswaan.",
      "order_index": 3,
      "is_active": true,
      "created_at": "2025-08-04T12:00:00.000000Z",
      "updated_at": "2025-08-04T12:00:00.000000Z"
    }
  ]
}
```

### **2. Get Single Struktur Organisasi**
```http
GET /struktur-organisasi/{id}
```

**Parameters:**
- `id` (integer) - ID struktur organisasi

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "position": "Kepala Sekolah",
    "name": "Drs. Mahmud Hasni, M.Pd.",
    "photo": "http://localhost:8000/storage/struktur-organisasi/kepala_sekolah.jpg",
    "description": "Bertanggung jawab atas keseluruhan pengelolaan dan pengembangan sekolah.",
    "order_index": 1,
    "is_active": true,
    "created_at": "2025-08-04T12:00:00.000000Z",
    "updated_at": "2025-08-04T12:00:00.000000Z"
  }
}
```

### **3. Get Struktur Organisasi Settings (Banner & Panel)**
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

### **4. Get Complete Struktur Organisasi Data**
```http
GET /struktur-organisasi/complete
```

**Response:**
```json
{
  "success": true,
  "data": {
    "settings": {
      "id": 1,
      "title": "Struktur Organisasi SMP Muhammadiyah Al Kautsar PK Kartasura",
      "subtitle": "Susunan organisasi pengelolaan sekolah yang efektif",
      "banner_desktop": "http://localhost:8000/storage/struktur-organisasi/banner_desktop.jpg",
      "banner_mobile": "http://localhost:8000/storage/struktur-organisasi/banner_mobile.jpg",
      "title_panel_bg_color": "bg-green-500",
      "subtitle_panel_bg_color": "bg-green-700",
      "mobile_panel_bg_color": "bg-green-700",
      "is_active": true
    },
    "content": [
      {
        "id": 1,
        "position": "Kepala Sekolah",
        "name": "Drs. Mahmud Hasni, M.Pd.",
        "photo": "http://localhost:8000/storage/struktur-organisasi/kepala_sekolah.jpg",
        "description": "Bertanggung jawab atas keseluruhan pengelolaan dan pengembangan sekolah.",
        "order_index": 1,
        "is_active": true
      },
      {
        "id": 2,
        "position": "Wakil Kepala Sekolah Bidang Kurikulum",
        "name": "Annisa Mayasari, S.Pd.",
        "photo": "http://localhost:8000/storage/struktur-organisasi/waka_kurikulum.jpg",
        "description": "Bertanggung jawab dalam pengembangan dan implementasi kurikulum sekolah.",
        "order_index": 2,
        "is_active": true
      }
    ]
  }
}
```

---

## 🎨 Data Structure Details

### **Panel Colors (Settings)**
| Value | Description | CSS Class |
|-------|-------------|-----------|
| `bg-green-500` | Hijau | `bg-green-500` |
| `bg-blue-500` | Biru | `bg-blue-500` |
| `bg-red-500` | Merah | `bg-red-500` |
| `bg-yellow-500` | Kuning | `bg-yellow-500` |
| `bg-purple-500` | Ungu | `bg-purple-500` |
| `bg-gray-500` | Abu-abu | `bg-gray-500` |

### **Field Descriptions**
| Field | Type | Description |
|-------|------|-------------|
| `position` | string | Jabatan dalam struktur organisasi |
| `name` | string | Nama lengkap pejabat |
| `photo` | string | URL foto pejabat (nullable) |
| `description` | text | Deskripsi tanggung jawab jabatan |
| `order_index` | integer | Urutan tampilan (ascending) |
| `is_active` | boolean | Status aktif/nonaktif |

---

## 🔧 Frontend Integration Example

### **React/Next.js Implementation**
```javascript
import { useState, useEffect } from 'react';

function StrukturOrganisasiPage() {
  const [data, setData] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetch('http://localhost:8000/api/v1/struktur-organisasi/complete')
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
          <div className="w-full bg-gradient-to-t from-green-900/80 via-green-800/40 to-transparent">
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
      <div className="w-full bg-gradient-to-r from-green-600 to-green-900 py-4 md:hidden">
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

      {/* Struktur Organisasi Content */}
      <main className="flex-grow container mx-auto px-4 py-8 bg-white">
        <div className="prose max-w-none">
          <div className="bg-white rounded-lg shadow-md p-6 mb-8">
            <h2 className="text-2xl font-semibold text-black mb-4">
              {data.settings.title}
            </h2>
            
            <p className="mb-6 text-black">
              Struktur organisasi SMP Muhammadiyah Al Kautsar PK Kartasura disusun untuk memastikan 
              pengelolaan sekolah yang efektif dan efisien dalam mencapai visi, misi, dan tujuan pendidikan.
            </p>
            
            {/* Diagram Struktur Organisasi */}
            <div className="mb-8 overflow-auto">
              <div className="min-w-[800px] p-4 bg-blue-50 rounded-lg">
                <div className="flex flex-col items-center">
                  {/* Kepala Sekolah */}
                  <div className="bg-primary text-white p-3 rounded-lg w-64 text-center mb-4">
                    <h3 className="font-bold">Kepala Sekolah</h3>
                    <p className="text-sm">Drs. Mahmud Hasni, M.Pd.</p>
                  </div>
                  
                  {/* Garis Penghubung */}
                  <div className="w-1 h-8 bg-gray-400"></div>
                  
                  {/* Level Wakil Kepala Sekolah */}
                  <div className="grid grid-cols-4 gap-4 mb-4">
                    <div className="bg-blue-600 text-white p-3 rounded-lg w-48 text-center">
                      <h3 className="font-bold text-sm">Waka Kurikulum</h3>
                      <p className="text-xs">Annisa Mayasari, S.Pd.</p>
                    </div>
                    <div className="bg-blue-600 text-white p-3 rounded-lg w-48 text-center">
                      <h3 className="font-bold text-sm">Waka Kesiswaan</h3>
                      <p className="text-xs">Ardiansyah P.P., S.Sn.</p>
                    </div>
                    <div className="bg-blue-600 text-white p-3 rounded-lg w-48 text-center">
                      <h3 className="font-bold text-sm">Waka Sarpras</h3>
                      <p className="text-xs">Bakhtiar Fahmi, S.Sn.</p>
                    </div>
                    <div className="bg-blue-600 text-white p-3 rounded-lg w-48 text-center">
                      <h3 className="font-bold text-sm">Waka Humas</h3>
                      <p className="text-xs">Cindy T., S.Pd, M.Pd.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            {/* Deskripsi Jabatan */}
            <h3 className="text-xl font-semibold text-primary mb-4">Profil Pejabat Struktural</h3>
            
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
              {data.content.map((item, index) => (
                <div key={index} className="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow">
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
      </main>
    </div>
  );
}

export default StrukturOrganisasiPage;
```

### **Tailwind CSS Classes Used**
```css
/* Panel Colors */
.bg-green-500 { background-color: rgb(34 197 94); }
.bg-blue-500 { background-color: rgb(59 130 246); }
.bg-red-500 { background-color: rgb(239 68 68); }
.bg-yellow-500 { background-color: rgb(234 179 8); }
.bg-purple-500 { background-color: rgb(168 85 247); }
.bg-gray-500 { background-color: rgb(107 114 128); }

/* Gradient Overlays */
.bg-gradient-to-t { background-image: linear-gradient(to top, var(--tw-gradient-stops)); }
.from-green-900\/80 { --tw-gradient-from: rgb(20 83 45 / 0.8); }
.via-green-800\/40 { --tw-gradient-via: rgb(22 101 52 / 0.4); }
.to-transparent { --tw-gradient-to: transparent; }

/* Grid Layouts */
.grid-cols-1 { grid-template-columns: repeat(1, minmax(0, 1fr)); }
.grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
.grid-cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
.grid-cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)); }
```

---

## 🎛️ Admin Panel Configuration

### **Access Admin Panel**
```
URL: http://localhost:8000/admin
Email: admin@admin.com
Password: admin123
```

### **Menu Location**
```
Profil Sekolah
├── Struktur Organisasi (untuk data pejabat)
└── Pengaturan Struktur Organisasi (untuk banner & panel)
```

### **Form Fields Description**

#### **Struktur Organisasi:**
- **Jabatan**: Nama jabatan (contoh: "Kepala Sekolah", "Wakil Kepala Sekolah")
- **Nama**: Nama lengkap pejabat
- **Foto**: Upload foto pejabat (rasio 3:4, ukuran 300x400px)
- **Deskripsi**: Deskripsi tanggung jawab jabatan
- **Urutan**: Angka untuk mengatur urutan tampilan
- **Aktif**: Toggle untuk menampilkan/menyembunyikan

#### **Pengaturan Struktur Organisasi:**
- **Judul Halaman**: Judul utama halaman
- **Subtitle**: Subtitle halaman
- **Banner Desktop**: Upload gambar banner desktop (16:9 ratio)
- **Banner Mobile**: Upload gambar banner mobile (16:9 ratio)
- **Warna Background Title Panel**: Warna panel judul
- **Warna Background Subtitle Panel**: Warna panel subtitle
- **Warna Background Mobile Panel**: Warna panel mobile
- **Aktif**: Toggle untuk menampilkan/menyembunyikan

---

## 📁 File Storage Structure

```
storage/app/public/struktur-organisasi/
├── banner_desktop.jpg
├── banner_mobile.jpg
├── kepala_sekolah.jpg
├── waka_kurikulum.jpg
├── waka_kesiswaan.jpg
└── ...
```

**File URLs:**
- Desktop Banner: `http://localhost:8000/storage/struktur-organisasi/banner_desktop.jpg`
- Mobile Banner: `http://localhost:8000/storage/struktur-organisasi/banner_mobile.jpg`
- Foto Pejabat: `http://localhost:8000/storage/struktur-organisasi/{filename}.jpg`

---

## 🚨 Error Handling

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

### **Error Examples**
```json
// Data not found
{
  "success": false,
  "message": "Data tidak ditemukan"
}

// Settings not found
{
  "success": false,
  "message": "Pengaturan tidak ditemukan"
}
```

---

## 🔍 Testing Examples

### **cURL Commands**
```bash
# Get all struktur organisasi
curl http://localhost:8000/api/v1/struktur-organisasi

# Get settings
curl http://localhost:8000/api/v1/struktur-organisasi/settings

# Get complete data
curl http://localhost:8000/api/v1/struktur-organisasi/complete

# Get single data
curl http://localhost:8000/api/v1/struktur-organisasi/1
```

### **JavaScript Fetch Examples**
```javascript
// Get complete data
fetch('http://localhost:8000/api/v1/struktur-organisasi/complete')
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      console.log('Settings:', data.data.settings);
      console.log('Content:', data.data.content);
    }
  });

// Get single data
fetch('http://localhost:8000/api/v1/struktur-organisasi/1')
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      console.log('Single data:', data.data);
    }
  });
```

---

## 📝 Notes

1. **Content Ordering**: Data diurutkan berdasarkan `order_index` (ascending)
2. **Active Status**: Hanya data dengan `is_active = true` yang dikembalikan
3. **Image Uploads**: Foto pejabat disimpan di `storage/app/public/struktur-organisasi/`
4. **Photo Ratio**: Foto pejabat menggunakan rasio 3:4 (portrait)
5. **Responsive Design**: Banner desktop dan mobile terpisah untuk responsive design
6. **Diagram Layout**: Struktur organisasi dapat ditampilkan dalam bentuk diagram
7. **Card Layout**: Data pejabat ditampilkan dalam card dengan foto dan deskripsi

---

**Dokumentasi API Struktur Organisasi selesai!** 🏢 
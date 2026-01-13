# 🎯 VISI MISI API DOCUMENTATION

## 📋 Overview
API untuk mengelola konten Visi, Misi, dan Tujuan sekolah dengan fitur grid layout yang fleksibel dan support list bullet points.

## 🔗 Base URL
```
http://localhost:8000/api/v1/visi-misi
```

---

## 📡 API Endpoints

### **1. Get All Visi Misi Content**
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
      "content": "<p>Menjadi lembaga pendidikan Islam yang unggul dalam membentuk generasi beriman, berilmu, berakhlak mulia, dan berwawasan global.</p>",
      "grid_type": "grid-cols-1",
      "use_list_disc": false,
      "list_items": null,
      "background_color": "bg-white",
      "border_color": "border-gray-200",
      "order_index": 1,
      "is_active": true,
      "created_at": "2025-08-04T12:00:00.000000Z",
      "updated_at": "2025-08-04T12:00:00.000000Z"
    },
    {
      "id": 2,
      "title": "Misi Sekolah",
      "content": "<p>Misi sekolah untuk mencapai visi yang telah ditetapkan.</p>",
      "grid_type": "grid-cols-2",
      "use_list_disc": true,
      "list_items": [
        {"item": "Menyelenggarakan pendidikan yang mengintegrasikan nilai-nilai Islam"},
        {"item": "Membiasakan praktik ibadah sehari-hari"},
        {"item": "Mengembangkan program tahfidz Al-Qur'an"}
      ],
      "background_color": "bg-blue-50",
      "border_color": "border-blue-200",
      "order_index": 2,
      "is_active": true,
      "created_at": "2025-08-04T12:00:00.000000Z",
      "updated_at": "2025-08-04T12:00:00.000000Z"
    }
  ]
}
```

### **2. Get Single Visi Misi Content**
```http
GET /visi-misi/{id}
```

**Parameters:**
- `id` (integer) - ID konten visi misi

**Response:**
```json
{
  "success": true,
  "data": {
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
}
```

### **3. Get Visi Misi Settings (Banner & Panel)**
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

### **4. Get Complete Visi Misi Data**
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

### **5. Get Content by Grid Type**
```http
GET /visi-misi/grid/{gridType}
```

**Parameters:**
- `gridType` (string) - Tipe grid layout

**Available Grid Types:**
- `grid-cols-1` - Layout 1 kolom
- `grid-cols-2` - Layout 2 kolom
- `grid-cols-3` - Layout 3 kolom
- `grid-cols-4` - Layout 4 kolom

**Example:**
```http
GET /visi-misi/grid/grid-cols-2
```

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 2,
      "title": "Misi Sekolah",
      "content": "<p>Misi sekolah untuk mencapai visi yang telah ditetapkan.</p>",
      "grid_type": "grid-cols-2",
      "use_list_disc": true,
      "list_items": [
        {"item": "Menyelenggarakan pendidikan yang mengintegrasikan nilai-nilai Islam"},
        {"item": "Membiasakan praktik ibadah sehari-hari"}
      ],
      "background_color": "bg-blue-50",
      "border_color": "border-blue-200",
      "order_index": 2,
      "is_active": true
    }
  ]
}
```

### **6. Get Content with List Items**
```http
GET /visi-misi/with-list-items
```

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 2,
      "title": "Misi Sekolah",
      "content": "<p>Misi sekolah untuk mencapai visi yang telah ditetapkan.</p>",
      "grid_type": "grid-cols-2",
      "use_list_disc": true,
      "list_items": [
        {"item": "Menyelenggarakan pendidikan yang mengintegrasikan nilai-nilai Islam"},
        {"item": "Membiasakan praktik ibadah sehari-hari"},
        {"item": "Mengembangkan program tahfidz Al-Qur'an"}
      ],
      "background_color": "bg-blue-50",
      "border_color": "border-blue-200",
      "order_index": 2,
      "is_active": true
    }
  ]
}
```

---

## 🎨 Data Structure Details

### **Grid Types**
| Value | Description | CSS Class |
|-------|-------------|-----------|
| `grid-cols-1` | Layout 1 kolom | `grid grid-cols-1` |
| `grid-cols-2` | Layout 2 kolom | `grid grid-cols-2` |
| `grid-cols-3` | Layout 3 kolom | `grid grid-cols-3` |
| `grid-cols-4` | Layout 4 kolom | `grid grid-cols-4` |

### **Background Colors**
| Value | Description | CSS Class |
|-------|-------------|-----------|
| `bg-white` | Putih | `bg-white` |
| `bg-gray-50` | Abu-abu Muda | `bg-gray-50` |
| `bg-blue-50` | Biru Muda | `bg-blue-50` |
| `bg-green-50` | Hijau Muda | `bg-green-50` |
| `bg-yellow-50` | Kuning Muda | `bg-yellow-50` |
| `bg-purple-50` | Ungu Muda | `bg-purple-50` |
| `bg-red-50` | Merah Muda | `bg-red-50` |

### **Border Colors**
| Value | Description | CSS Class |
|-------|-------------|-----------|
| `border-gray-200` | Abu-abu | `border-gray-200` |
| `border-blue-200` | Biru | `border-blue-200` |
| `border-green-200` | Hijau | `border-green-200` |
| `border-yellow-200` | Kuning | `border-yellow-200` |
| `border-purple-200` | Ungu | `border-purple-200` |
| `border-red-200` | Merah | `border-red-200` |
| `border-transparent` | Transparan | `border-transparent` |

### **Panel Colors (Settings)**
| Value | Description | CSS Class |
|-------|-------------|-----------|
| `bg-green-500` | Hijau | `bg-green-500` |
| `bg-blue-500` | Biru | `bg-blue-500` |
| `bg-red-500` | Merah | `bg-red-500` |
| `bg-yellow-500` | Kuning | `bg-yellow-500` |
| `bg-purple-500` | Ungu | `bg-purple-500` |
| `bg-gray-500` | Abu-abu | `bg-gray-500` |

---

## 🔧 Frontend Integration Example

### **React/Next.js Implementation**
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
          <div className="w-full bg-gradient-to-t from-black/80 via-black/40 to-transparent">
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

      {/* Content Sections */}
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
                  <ul className="list-disc pl-5 space-y-2 text-black">
                    {section.list_items.map((item, idx) => (
                      <li key={idx} className="text-black">{item.item}</li>
                    ))}
                  </ul>
                )}
              </div>
            </div>
          ))}
        </div>
      </main>
    </div>
  );
}

export default VisiMisiPage;
```

### **Tailwind CSS Classes Used**
```css
/* Grid Layouts */
.grid-cols-1 { grid-template-columns: repeat(1, minmax(0, 1fr)); }
.grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
.grid-cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
.grid-cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)); }

/* Background Colors */
.bg-white { background-color: rgb(255 255 255); }
.bg-gray-50 { background-color: rgb(249 250 251); }
.bg-blue-50 { background-color: rgb(239 246 255); }
.bg-green-50 { background-color: rgb(240 253 244); }
.bg-yellow-50 { background-color: rgb(254 252 232); }
.bg-purple-50 { background-color: rgb(250 245 255); }
.bg-red-50 { background-color: rgb(254 242 242); }

/* Border Colors */
.border-gray-200 { border-color: rgb(229 231 235); }
.border-blue-200 { border-color: rgb(191 219 254); }
.border-green-200 { border-color: rgb(187 247 208); }
.border-yellow-200 { border-color: rgb(254 240 138); }
.border-purple-200 { border-color: rgb(233 213 255); }
.border-red-200 { border-color: rgb(254 202 202); }
.border-transparent { border-color: transparent; }
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
├── Visi Misi (untuk konten)
└── Pengaturan Visi Misi (untuk banner & panel)
```

### **Form Fields Description**

#### **Visi Misi Content:**
- **Judul**: Judul section (contoh: "Visi Sekolah", "Misi Sekolah")
- **Konten**: Rich text editor untuk konten HTML
- **Tipe Grid**: Pilihan layout (1-4 kolom)
- **Gunakan List Bullet**: Toggle untuk mengaktifkan list bullet
- **Item List**: Repeater field untuk list items (muncul jika list bullet aktif)
- **Warna Background**: Pilihan warna background section
- **Warna Border**: Pilihan warna border section
- **Urutan**: Angka untuk mengatur urutan tampilan
- **Aktif**: Toggle untuk menampilkan/menyembunyikan

#### **Pengaturan Visi Misi:**
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
storage/app/public/visi-misi/
├── banner_desktop.jpg
├── banner_mobile.jpg
└── ...
```

**File URLs:**
- Desktop Banner: `http://localhost:8000/storage/visi-misi/banner_desktop.jpg`
- Mobile Banner: `http://localhost:8000/storage/visi-misi/banner_mobile.jpg`

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

// Server error
{
  "success": false,
  "message": "Terjadi kesalahan: Database connection failed"
}
```

---

## 🔍 Testing Examples

### **cURL Commands**
```bash
# Get all content
curl http://localhost:8000/api/v1/visi-misi

# Get settings
curl http://localhost:8000/api/v1/visi-misi/settings

# Get complete data
curl http://localhost:8000/api/v1/visi-misi/complete

# Get content with grid-cols-2
curl http://localhost:8000/api/v1/visi-misi/grid/grid-cols-2

# Get content with list items
curl http://localhost:8000/api/v1/visi-misi/with-list-items

# Get single content
curl http://localhost:8000/api/v1/visi-misi/1
```

### **JavaScript Fetch Examples**
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

// Get content by grid type
fetch('http://localhost:8000/api/v1/visi-misi/grid/grid-cols-2')
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      console.log('Grid-cols-2 content:', data.data);
    }
  });
```

---

## 📝 Notes

1. **Content Ordering**: Data diurutkan berdasarkan `order_index` (ascending)
2. **Active Status**: Hanya data dengan `is_active = true` yang dikembalikan
3. **Image Uploads**: Banner images disimpan di `storage/app/public/visi-misi/`
4. **Grid Layouts**: Gunakan `grid_type` untuk mengatur layout konten
5. **List Items**: Aktifkan `use_list_disc` dan isi `list_items` untuk bullet points
6. **Rich Content**: Field `content` mendukung HTML tags
7. **Responsive Design**: Banner desktop dan mobile terpisah untuk responsive design

---

**Dokumentasi API Visi Misi selesai!** 🎯 
# 🎨 EKSTRAKURIKULER API DOCUMENTATION

## 📋 Overview
API untuk mengelola data ekstrakurikuler sekolah dengan informasi kategori, jadwal, lokasi, pembina, dan deskripsi kegiatan.

## 🔗 Base URL
```
http://localhost:8000/api/v1/ekstrakurikuler
```

---

## 📡 API Endpoints

### **1. Get All Ekstrakurikuler**
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
      "image": "http://localhost:8000/storage/ekstrakurikuler/sepak_bola.jpg",
      "category": "Olahraga",
      "jadwal": "Jumat 13.00-15.00",
      "location": "Lapangan Sekolah",
      "pembina": "Pak Ahmad",
      "description": "<p>Ekstrakurikuler sepak bola dirancang untuk mengembangkan kemampuan fisik, teknik bermain, dan kerjasama tim. Kegiatan ini meliputi latihan teknik dasar, taktik permainan, dan pertandingan persahabatan.</p>",
      "order_index": 1,
      "is_active": true,
      "created_at": "2025-08-04T12:00:00.000000Z",
      "updated_at": "2025-08-04T12:00:00.000000Z"
    },
    {
      "id": 2,
      "title": "Basket",
      "excerpt": "Melatih kemampuan basket dan strategi permainan untuk kompetisi antar sekolah.",
      "image": "http://localhost:8000/storage/ekstrakurikuler/basket.jpg",
      "category": "Olahraga",
      "jadwal": "Sabtu 13.00-15.00",
      "location": "Lapangan Basket",
      "pembina": "Bu Sarah",
      "description": "<p>Ekstrakurikuler basket fokus pada pengembangan teknik dribbling, shooting, dan strategi permainan. Siswa dilatih untuk berkompetisi dalam turnamen antar sekolah.</p>",
      "order_index": 2,
      "is_active": true,
      "created_at": "2025-08-04T12:00:00.000000Z",
      "updated_at": "2025-08-04T12:00:00.000000Z"
    },
    {
      "id": 3,
      "title": "Tari Tradisional",
      "excerpt": "Melestarikan budaya Indonesia melalui tarian tradisional dari berbagai daerah.",
      "image": "http://localhost:8000/storage/ekstrakurikuler/tari_tradisional.jpg",
      "category": "Seni Budaya",
      "jadwal": "Jumat 15.00-17.00",
      "location": "Aula Sekolah",
      "pembina": "Bu Sari",
      "description": "<p>Ekstrakurikuler tari tradisional bertujuan melestarikan budaya Indonesia. Siswa belajar berbagai tarian daerah seperti tari Saman, tari Piring, dan tari Jaipong.</p>",
      "order_index": 3,
      "is_active": true,
      "created_at": "2025-08-04T12:00:00.000000Z",
      "updated_at": "2025-08-04T12:00:00.000000Z"
    }
  ]
}
```

### **2. Get Single Ekstrakurikuler**
```http
GET /ekstrakurikuler/{id}
```

**Parameters:**
- `id` (integer) - ID ekstrakurikuler

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "title": "Sepak Bola",
    "excerpt": "Ekstrakurikuler sepak bola untuk mengembangkan kemampuan olahraga dan kerjasama tim.",
    "image": "http://localhost:8000/storage/ekstrakurikuler/sepak_bola.jpg",
    "category": "Olahraga",
    "jadwal": "Jumat 13.00-15.00",
    "location": "Lapangan Sekolah",
    "pembina": "Pak Ahmad",
    "description": "<p>Ekstrakurikuler sepak bola dirancang untuk mengembangkan kemampuan fisik, teknik bermain, dan kerjasama tim.</p>",
    "order_index": 1,
    "is_active": true,
    "created_at": "2025-08-04T12:00:00.000000Z",
    "updated_at": "2025-08-04T12:00:00.000000Z"
  }
}
```

### **3. Get Ekstrakurikuler Settings (Banner & Panel)**
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

### **4. Get Complete Ekstrakurikuler Data**
```http
GET /ekstrakurikuler/complete
```

**Response:**
```json
{
  "success": true,
  "data": {
    "settings": {
      "id": 1,
      "title": "Ekstrakurikuler",
      "subtitle": "Temukan minat dan bakatmu melalui berbagai kegiatan ekstrakurikuler",
      "banner_desktop": "http://localhost:8000/storage/ekstrakurikuler/banner_desktop.jpg",
      "banner_mobile": "http://localhost:8000/storage/ekstrakurikuler/banner_mobile.jpg",
      "title_panel_bg_color": "bg-gradient-to-r from-blue-600 to-blue-800",
      "subtitle_panel_bg_color": "bg-gradient-to-r from-blue-700 to-blue-900",
      "mobile_panel_bg_color": "bg-gradient-to-r from-blue-700 to-blue-800",
      "is_active": true
    },
    "content": [
      {
        "id": 1,
        "title": "Sepak Bola",
        "excerpt": "Ekstrakurikuler sepak bola untuk mengembangkan kemampuan olahraga dan kerjasama tim.",
        "image": "http://localhost:8000/storage/ekstrakurikuler/sepak_bola.jpg",
        "category": "Olahraga",
        "jadwal": "Jumat 13.00-15.00",
        "location": "Lapangan Sekolah",
        "pembina": "Pak Ahmad",
        "description": "<p>Ekstrakurikuler sepak bola dirancang untuk mengembangkan kemampuan fisik, teknik bermain, dan kerjasama tim.</p>",
        "order_index": 1,
        "is_active": true
      }
    ]
  }
}
```

### **5. Get Ekstrakurikuler by Category**
```http
GET /ekstrakurikuler/category/{category}
```

**Parameters:**
- `category` (string) - Kategori ekstrakurikuler

**Available Categories:**
- `Olahraga` - Ekstrakurikuler olahraga
- `Seni Budaya` - Ekstrakurikuler seni dan budaya
- `Teknologi` - Ekstrakurikuler teknologi
- `Semua Ekstrakurikuler` - Semua kategori (akan mengembalikan semua data)

**Example:**
```http
GET /ekstrakurikuler/category/Olahraga
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
      "image": "http://localhost:8000/storage/ekstrakurikuler/sepak_bola.jpg",
      "category": "Olahraga",
      "jadwal": "Jumat 13.00-15.00",
      "location": "Lapangan Sekolah",
      "pembina": "Pak Ahmad",
      "description": "<p>Ekstrakurikuler sepak bola dirancang untuk mengembangkan kemampuan fisik, teknik bermain, dan kerjasama tim.</p>",
      "order_index": 1,
      "is_active": true
    },
    {
      "id": 2,
      "title": "Basket",
      "excerpt": "Melatih kemampuan basket dan strategi permainan untuk kompetisi antar sekolah.",
      "image": "http://localhost:8000/storage/ekstrakurikuler/basket.jpg",
      "category": "Olahraga",
      "jadwal": "Sabtu 13.00-15.00",
      "location": "Lapangan Basket",
      "pembina": "Bu Sarah",
      "description": "<p>Ekstrakurikuler basket fokus pada pengembangan teknik dribbling, shooting, dan strategi permainan.</p>",
      "order_index": 2,
      "is_active": true
    }
  ]
}
```

---

## 🎨 Data Structure Details

### **Panel Colors (Settings) - Gradient**
| Value | Description | CSS Class |
|-------|-------------|-----------|
| `bg-gradient-to-r from-blue-600 to-blue-800` | Biru gradient | `bg-gradient-to-r from-blue-600 to-blue-800` |
| `bg-gradient-to-r from-blue-700 to-blue-900` | Biru gelap gradient | `bg-gradient-to-r from-blue-700 to-blue-900` |
| `bg-gradient-to-r from-blue-700 to-blue-800` | Biru medium gradient | `bg-gradient-to-r from-blue-700 to-blue-800` |

### **Categories**
| Category | Description |
|----------|-------------|
| `Olahraga` | Ekstrakurikuler bidang olahraga |
| `Seni Budaya` | Ekstrakurikuler bidang seni dan budaya |
| `Teknologi` | Ekstrakurikuler bidang teknologi |

### **Field Descriptions**
| Field | Type | Description |
|-------|------|-------------|
| `title` | string | Nama ekstrakurikuler |
| `excerpt` | text | Ringkasan singkat ekstrakurikuler |
| `image` | string | URL gambar ekstrakurikuler (nullable) |
| `category` | string | Kategori ekstrakurikuler |
| `jadwal` | string | Jadwal kegiatan (nullable) |
| `location` | string | Lokasi kegiatan |
| `pembina` | string | Nama pembina ekstrakurikuler |
| `description` | longText | Deskripsi lengkap ekstrakurikuler (nullable) |
| `order_index` | integer | Urutan tampilan (ascending) |
| `is_active` | boolean | Status aktif/nonaktif |

---

## 🔧 Frontend Integration Example

### **React/Next.js Implementation**
```javascript
import { useState, useEffect } from 'react';
import { Search, MapPin, Users, Clock } from 'lucide-react';

function EkstrakurikulerPage() {
  const [data, setData] = useState(null);
  const [loading, setLoading] = useState(true);
  const [searchTerm, setSearchTerm] = useState('');
  const [selectedCategory, setSelectedCategory] = useState('Semua Ekstrakurikuler');

  useEffect(() => {
    fetch('http://localhost:8000/api/v1/ekstrakurikuler/complete')
      .then(response => response.json())
      .then(result => {
        if (result.success) {
          setData(result.data);
        }
        setLoading(false);
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

  if (loading) return <div>Loading...</div>;
  if (!data) return <div>No data</div>;

  // Filter ekstrakurikuler berdasarkan pencarian dan kategori
  const filteredEkstrakurikuler = data.content.filter(ekstrakurikuler => {
    const matchesSearch = ekstrakurikuler.title.toLowerCase().includes(searchTerm.toLowerCase()) ||
                         ekstrakurikuler.excerpt.toLowerCase().includes(searchTerm.toLowerCase());
    const matchesCategory = selectedCategory === 'Semua Ekstrakurikuler' || ekstrakurikuler.category === selectedCategory;
    return matchesSearch && matchesCategory;
  });

  return (
    <div className="min-h-screen bg-white">
      {/* Banner Section */}
      <section className="relative h-[70vh] mx-auto flex items-center justify-center overflow-hidden">
        <div 
          className="absolute inset-0 bg-cover bg-center z-0"
          style={{
            backgroundImage: `url('${data.settings.banner_desktop}')`
          }}
        >
          <div className="absolute inset-0 bg-gradient-to-r from-blue-900/80 via-blue-800/60 to-transparent"></div>
        </div>
        <div className="relative z-10 text-center px-4">
          <div className="max-w-4xl mx-auto">
            <h1 className="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight">
              {data.settings.title}
              <span className="block text-yellow-400">Sekolah Kami</span>
            </h1>
            <p className="text-lg md:text-xl text-gray-200 max-w-2xl mx-auto">
              {data.settings.subtitle}
            </p>
          </div>
        </div>
      </section>

      {/* Search and Filter Section */}
      <div className="bg-gradient-to-b from-white to-gray-50 flex-1">
        <div className="container mx-auto px-4 py-12">
          <div className="bg-white rounded-2xl shadow-lg p-8 mb-8">
            <div className="grid md:grid-cols-2 gap-6 items-center">
              {/* Search Bar */}
              <div className="relative">
                <Search className="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400" size={20} />
                <input
                  type="text"
                  placeholder="Cari ekstrakurikuler favoritmu..."
                  value={searchTerm}
                  onChange={(e) => setSearchTerm(e.target.value)}
                  className="w-full pl-12 pr-4 py-4 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50 hover:bg-white transition-colors"
                />
              </div>
              
              {/* Category Filter */}
              <div className="flex flex-wrap gap-2 justify-center md:justify-end">
                {['Semua Ekstrakurikuler', 'Olahraga', 'Seni Budaya', 'Teknologi'].map((category) => (
                  <button
                    key={category}
                    onClick={() => handleCategoryChange(category)}
                    className={`px-5 py-2.5 rounded-full font-medium transition-all transform hover:scale-105 ${
                      selectedCategory === category
                        ? 'bg-gradient-to-r from-blue-600 to-blue-700 text-white shadow-lg'
                        : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
                    }`}
                  >
                    {category}
                  </button>
                ))}
              </div>
            </div>
          </div>

          {/* Title */}
          <div className="text-center mb-12">
            <h2 className="text-3xl font-bold text-gray-800 mb-3">Jelajahi Semua Ekstrakurikuler</h2>
            <p className="text-gray-600 text-lg">{filteredEkstrakurikuler.length} ekstrakurikuler tersedia untukmu</p>
            <div className="w-24 h-1 bg-gradient-to-r from-blue-600 to-yellow-400 mx-auto mt-4"></div>
          </div>

          {/* Ekstrakurikuler Grid */}
          <div className="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-8">
            {filteredEkstrakurikuler.map((ekstrakurikuler) => (
              <div key={ekstrakurikuler.id} className="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
                <div className="relative h-32 overflow-hidden">
                  <img 
                    src={ekstrakurikuler.image} 
                    alt={ekstrakurikuler.title}
                    className="w-full h-full object-cover"
                  />
                </div>
                <div className="p-3">
                  <h3 className="text-sm font-semibold text-gray-800 mb-1">{ekstrakurikuler.title}</h3>
                  <p className="text-xs text-gray-600 mb-2 line-clamp-2">{ekstrakurikuler.excerpt}</p>
                  <div className="space-y-1">
                    <div className="flex items-center text-xs text-gray-500">
                      <Clock size={12} className="mr-1" />
                      <span>{ekstrakurikuler.jadwal}</span>
                    </div>
                    <div className="flex items-center text-xs text-gray-500">
                      <MapPin size={12} className="mr-1" />
                      <span className="truncate">{ekstrakurikuler.location}</span>
                    </div>
                    <div className="flex items-center text-xs text-gray-500">
                      <Users size={12} className="mr-1" />
                      <span className="truncate">{ekstrakurikuler.pembina}</span>
                    </div>
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>
      </div>
    </div>
  );
}

export default EkstrakurikulerPage;
```

### **Tailwind CSS Classes Used**
```css
/* Gradient Colors */
.bg-gradient-to-r { background-image: linear-gradient(to right, var(--tw-gradient-stops)); }
.from-blue-600 { --tw-gradient-from: rgb(37 99 235); }
.to-blue-800 { --tw-gradient-to: rgb(30 64 175); }
.from-blue-700 { --tw-gradient-from: rgb(29 78 216); }
.to-blue-900 { --tw-gradient-to: rgb(30 58 138); }

/* Overlay Gradients */
.bg-gradient-to-b { background-image: linear-gradient(to bottom, var(--tw-gradient-stops)); }
.from-blue-900\/80 { --tw-gradient-from: rgb(30 58 138 / 0.8); }
.via-blue-800\/60 { --tw-gradient-via: rgb(30 64 175 / 0.6); }
.to-transparent { --tw-gradient-to: transparent; }

/* Grid Layouts */
.grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
.grid-cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }

/* Line Clamp */
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
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
├── Ekstrakurikuler (untuk data ekstrakurikuler)
└── Pengaturan Ekstrakurikuler (untuk banner & panel)
```

### **Form Fields Description**

#### **Ekstrakurikuler:**
- **Judul**: Nama ekstrakurikuler (contoh: "Sepak Bola", "Tari Tradisional")
- **Ringkasan**: Deskripsi singkat ekstrakurikuler
- **Gambar**: Upload gambar ekstrakurikuler
- **Kategori**: Pilihan kategori (Olahraga, Seni Budaya, Teknologi)
- **Jadwal**: Jadwal kegiatan (opsional)
- **Lokasi**: Lokasi kegiatan
- **Pembina**: Nama pembina ekstrakurikuler
- **Deskripsi**: Deskripsi lengkap ekstrakurikuler (opsional)
- **Urutan**: Angka untuk mengatur urutan tampilan
- **Aktif**: Toggle untuk menampilkan/menyembunyikan

#### **Pengaturan Ekstrakurikuler:**
- **Judul Halaman**: Judul utama halaman
- **Subtitle**: Subtitle halaman
- **Banner Desktop**: Upload gambar banner desktop (16:9 ratio)
- **Banner Mobile**: Upload gambar banner mobile (16:9 ratio)
- **Warna Background Title Panel**: Warna gradient panel judul
- **Warna Background Subtitle Panel**: Warna gradient panel subtitle
- **Warna Background Mobile Panel**: Warna gradient panel mobile
- **Aktif**: Toggle untuk menampilkan/menyembunyikan

---

## 📁 File Storage Structure

```
storage/app/public/ekstrakurikuler/
├── banner_desktop.jpg
├── banner_mobile.jpg
├── sepak_bola.jpg
├── basket.jpg
├── tari_tradisional.jpg
├── musik.jpg
├── robotika.jpg
└── ...
```

**File URLs:**
- Desktop Banner: `http://localhost:8000/storage/ekstrakurikuler/banner_desktop.jpg`
- Mobile Banner: `http://localhost:8000/storage/ekstrakurikuler/banner_mobile.jpg`
- Gambar Ekstrakurikuler: `http://localhost:8000/storage/ekstrakurikuler/{filename}.jpg`

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
# Get all ekstrakurikuler
curl http://localhost:8000/api/v1/ekstrakurikuler

# Get settings
curl http://localhost:8000/api/v1/ekstrakurikuler/settings

# Get complete data
curl http://localhost:8000/api/v1/ekstrakurikuler/complete

# Get by category
curl http://localhost:8000/api/v1/ekstrakurikuler/category/Olahraga

# Get single data
curl http://localhost:8000/api/v1/ekstrakurikuler/1
```

### **JavaScript Fetch Examples**
```javascript
// Get complete data
fetch('http://localhost:8000/api/v1/ekstrakurikuler/complete')
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      console.log('Settings:', data.data.settings);
      console.log('Content:', data.data.content);
    }
  });

// Get by category
fetch('http://localhost:8000/api/v1/ekstrakurikuler/category/Olahraga')
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      console.log('Olahraga ekstrakurikuler:', data.data);
    }
  });

// Get single data
fetch('http://localhost:8000/api/v1/ekstrakurikuler/1')
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
3. **Image Uploads**: Gambar ekstrakurikuler disimpan di `storage/app/public/ekstrakurikuler/`
4. **Category Filtering**: API mendukung filter berdasarkan kategori
5. **Responsive Design**: Banner desktop dan mobile terpisah untuk responsive design
6. **Gradient Colors**: Menggunakan gradient biru untuk tema ekstrakurikuler
7. **Search Functionality**: Frontend dapat mengimplementasikan pencarian berdasarkan judul dan ringkasan
8. **Card Layout**: Data ekstrakurikuler ditampilkan dalam card dengan gambar dan informasi lengkap

---

**Dokumentasi API Ekstrakurikuler selesai!** 🎨 
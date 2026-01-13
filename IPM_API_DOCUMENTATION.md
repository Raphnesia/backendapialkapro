# 🕌 IPM (IKATAN PELAJAR MUHAMMADIYAH) API DOCUMENTATION

## 📋 Overview
API untuk mengelola data pengurus IPM (Ikatan Pelajar Muhammadiyah) dengan informasi jabatan, nama, foto, kelas, dan deskripsi.

## 🔗 Base URL
```
http://localhost:8000/api/v1/ipm
```

---

## 📡 API Endpoints

### **1. Get All IPM Data**
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
      "photo": "http://localhost:8000/storage/ipm/ketua_ipm.jpg",
      "kelas": "IX A",
      "description": "Ketua IPM SMP Muhammadiyah Al Kautsar PK Kartasura",
      "order_index": 1,
      "is_active": true,
      "created_at": "2025-08-04T12:00:00.000000Z",
      "updated_at": "2025-08-04T12:00:00.000000Z"
    },
    {
      "id": 2,
      "position": "Wakil Ketua",
      "name": "Zahra Aulia",
      "photo": "http://localhost:8000/storage/ipm/wakil_ketua.jpg",
      "kelas": "IX B",
      "description": "Wakil Ketua IPM SMP Muhammadiyah Al Kautsar PK Kartasura",
      "order_index": 2,
      "is_active": true,
      "created_at": "2025-08-04T12:00:00.000000Z",
      "updated_at": "2025-08-04T12:00:00.000000Z"
    },
    {
      "id": 3,
      "position": "Sekretaris",
      "name": "Nabila Putri",
      "photo": "http://localhost:8000/storage/ipm/sekretaris.jpg",
      "kelas": "VIII A",
      "description": "Sekretaris IPM SMP Muhammadiyah Al Kautsar PK Kartasura",
      "order_index": 3,
      "is_active": true,
      "created_at": "2025-08-04T12:00:00.000000Z",
      "updated_at": "2025-08-04T12:00:00.000000Z"
    }
  ]
}
```

### **2. Get Single IPM Data**
```http
GET /ipm/{id}
```

**Parameters:**
- `id` (integer) - ID pengurus IPM

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "position": "Ketua IPM",
    "name": "Ahmad Fauzan",
    "photo": "http://localhost:8000/storage/ipm/ketua_ipm.jpg",
    "kelas": "IX A",
    "description": "Ketua IPM SMP Muhammadiyah Al Kautsar PK Kartasura",
    "order_index": 1,
    "is_active": true,
    "created_at": "2025-08-04T12:00:00.000000Z",
    "updated_at": "2025-08-04T12:00:00.000000Z"
  }
}
```

### **3. Get IPM Settings (Banner & Panel)**
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

### **4. Get Complete IPM Data**
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
    "content": [
      {
        "id": 1,
        "position": "Ketua IPM",
        "name": "Ahmad Fauzan",
        "photo": "http://localhost:8000/storage/ipm/ketua_ipm.jpg",
        "kelas": "IX A",
        "description": "Ketua IPM SMP Muhammadiyah Al Kautsar PK Kartasura",
        "order_index": 1,
        "is_active": true
      },
      {
        "id": 2,
        "position": "Wakil Ketua",
        "name": "Zahra Aulia",
        "photo": "http://localhost:8000/storage/ipm/wakil_ketua.jpg",
        "kelas": "IX B",
        "description": "Wakil Ketua IPM SMP Muhammadiyah Al Kautsar PK Kartasura",
        "order_index": 2,
        "is_active": true
      }
    ]
  }
}
```

---

## 🎨 Data Structure Details

### **Panel Colors (Settings) - Gradient**
| Value | Description | CSS Class |
|-------|-------------|-----------|
| `bg-gradient-to-r from-red-600 to-red-800` | Merah gradient | `bg-gradient-to-r from-red-600 to-red-800` |
| `bg-gradient-to-r from-red-700 to-red-900` | Merah gelap gradient | `bg-gradient-to-r from-red-700 to-red-900` |
| `bg-gradient-to-r from-red-700 to-red-800` | Merah medium gradient | `bg-gradient-to-r from-red-700 to-red-800` |

### **Field Descriptions**
| Field | Type | Description |
|-------|------|-------------|
| `position` | string | Jabatan dalam organisasi IPM |
| `name` | string | Nama lengkap pengurus |
| `photo` | string | URL foto pengurus (nullable) |
| `kelas` | string | Kelas pengurus (contoh: "IX A", "VIII B") |
| `description` | text | Deskripsi jabatan (nullable) |
| `order_index` | integer | Urutan tampilan (ascending) |
| `is_active` | boolean | Status aktif/nonaktif |

---

## 🔧 Frontend Integration Example

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

      {/* IPM Content */}
      <main className="flex-grow container mx-auto px-4 py-8 bg-white">
        <h1 className="text-3xl font-bold text-primary mb-6">Ikatan Pelajar Muhammadiyah (IPM)</h1>
        
        <div className="prose max-w-none">
          {/* Pengenalan IPM */}
          <div className="bg-white rounded-lg shadow-md p-6 mb-8">
            <h2 className="text-2xl font-semibold text-black mb-4">Tentang IPM</h2>
            
            <div className="flex flex-col md:flex-row gap-6">
              <div className="md:w-2/3">
                <p className="mb-4 text-black">
                  Ikatan Pelajar Muhammadiyah (IPM) adalah organisasi otonom Muhammadiyah yang bergerak di kalangan pelajar. 
                  Di SMP Muhammadiyah Al Kautsar PK Kartasura, IPM menjadi wadah bagi siswa untuk mengembangkan jiwa 
                  kepemimpinan, kreativitas, dan aktivitas sosial keagamaan sesuai dengan nilai-nilai Islam dan 
                  Kemuhammadiyahan.
                </p>
                
                <div className="bg-blue-50 p-4 rounded-lg mb-4">
                  <h3 className="text-lg font-semibold text-black mb-2">Visi IPM</h3>
                  <p className="italic text-black">
                    "Terwujudnya pelajar muslim yang berilmu, berakhlak mulia, dan terampil dalam rangka menegakkan 
                    dan menjunjung tinggi nilai-nilai Islam sehingga terwujud masyarakat Islam yang sebenar-benarnya."
                  </p>
                </div>
              </div>
              
              <div className="md:w-1/3">
                <div className="bg-primary rounded-lg overflow-hidden">
                  <div className="p-4 bg-gradient-to-r from-red-600 to-red-800 text-white text-center">
                    <h3 className="font-bold text-lg text-white">Struktur Organisasi IPM</h3>
                  </div>
                  <div className="p-4 bg-white text-black">
                    <ul className="space-y-2">
                      {data.content.map((item, index) => (
                        <li key={index} className="flex justify-between items-center border-b pb-2">
                          <span className="font-medium">{item.position}</span>
                          <span>{item.name}</span>
                        </li>
                      ))}
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          {/* Pengurus IPM - Layout dengan foto dan teks */}
          {data.content.map((item, index) => (
            <section key={index} className="relative lg:h-[400px] h-auto mb-8">
              <img 
                draggable={false} 
                alt="banner" 
                src="https://www.ums.ac.id/__image__/uploads/KZ4tligbcEdhZFxCLan8FNQMirVQuIYtCOMHLOqd.svg" 
                className="w-full absolute inset-0 object-cover h-full" 
              />
              
              <div className="relative lg:absolute top-0 w-full h-full flex">
                <div className="w-full lg:relative mt-auto">
                  <div className="flex justify-center mx-0 mt-3 lg:mt-5 px-4">
                    {/* Mobile Layout */}
                    <div className="w-full lg:hidden flex flex-col items-center text-center py-6">
                      <div className="mb-6">
                        <img 
                          draggable={false} 
                          alt={`${item.position} image`} 
                          src={item.photo} 
                          className="rounded-full bg-gray-300 mx-auto" 
                          style={{width: '35vw', height: '35vw', objectFit: 'cover'}} 
                        />
                      </div>
                      
                      <div className="px-4 text-left">
                        <h4 className="text-sm mb-2 text-black">{item.position}</h4>
                        <h3 className="mb-2 font-bold text-black" style={{fontSize: '28px'}}>{item.name}</h3>
                        <div className="flex mb-3">
                          <span className="w-16 h-1 bg-green-600"></span>
                        </div>
                        <p className="font-semibold text-sm font-regular mb-4 text-black">
                          {item.description}
                        </p>
                        <p className="text-sm text-gray-600">Kelas: {item.kelas}</p>
                      </div>
                    </div>
                    
                    {/* Desktop Layout */}
                    <div className="hidden lg:flex w-full max-w-6xl mx-auto">
                      {index % 2 === 0 ? (
                        // Foto di kiri, teks di kanan
                        <>
                          <div className="w-5/12 flex items-end justify-center relative z-20">
                            <img 
                              draggable={false} 
                              alt={`${item.position} image`} 
                              src={item.photo}
                              className="max-w-xs h-auto object-cover" 
                              style={{maxHeight: '300px', width: 'auto'}} 
                            />
                          </div>
                          <div className="w-7/12 pt-3 text-left lg:text-right flex items-center relative z-10" style={{marginBottom: '6rem'}}>
                            <div>
                              <h4 className="text-lg font-medium text-black mb-2">{item.position}</h4>
                              <h3 className="mb-1 text-2xl lg:text-3xl font-bold text-black">{item.name}</h3>
                              <div className="flex justify-start mb-3">
                                <span className="w-16 h-1 bg-green-600 mb-3"></span>
                              </div>
                              <p className="font-bold text-lg font-semibold text-black mb-4">{item.description}</p>
                              <p className="text-sm text-gray-600">Kelas: {item.kelas}</p>
                            </div>
                          </div>
                        </>
                      ) : (
                        // Teks di kiri, foto di kanan
                        <>
                          <div className="w-7/12 pt-3 text-left flex items-center relative z-10" style={{marginBottom: '6rem'}}>
                            <div>
                              <h4 className="text-lg font-medium text-black mb-2">{item.position}</h4>
                              <h3 className="mb-1 text-2xl lg:text-3xl font-bold text-black">{item.name}</h3>
                              <div className="flex justify-start mb-3">
                                <span className="w-16 h-1 bg-green-600 mb-3"></span>
                              </div>
                              <p className="font-bold text-lg font-semibold text-black mb-4">{item.description}</p>
                              <p className="text-sm text-gray-600">Kelas: {item.kelas}</p>
                            </div>
                          </div>
                          <div className="w-5/12 flex items-end justify-center relative z-20">
                            <img 
                              draggable={false} 
                              alt={`${item.position} image`} 
                              src={item.photo}
                              className="max-w-xs h-auto object-cover" 
                              style={{maxHeight: '300px', width: 'auto'}} 
                            />
                          </div>
                        </>
                      )}
                    </div>
                  </div>
                  
                  {/* Footer */}
                  <div className="w-full h-12 bg-gradient-to-r from-red-600 to-red-800 flex justify-center absolute bottom-0 mx-0 z-0">
                    <div className="hidden lg:block lg:w-5/12"></div>
                    <div className="w-full lg:w-7/12 text-sm font-bold text-white py-3 text-right flex items-center justify-end pr-4">
                      {/* Footer content dapat ditambahkan di sini */}
                    </div>
                  </div>
                </div>
              </div>
            </section>
          ))}
        </div>
      </main>
    </div>
  );
}

export default IPMPage;
```

### **Tailwind CSS Classes Used**
```css
/* Gradient Colors */
.bg-gradient-to-r { background-image: linear-gradient(to right, var(--tw-gradient-stops)); }
.from-red-600 { --tw-gradient-from: rgb(220 38 38); }
.to-red-800 { --tw-gradient-to: rgb(153 27 27); }
.from-red-700 { --tw-gradient-from: rgb(185 28 28); }
.to-red-900 { --tw-gradient-to: rgb(127 29 29); }

/* Overlay Gradients */
.bg-gradient-to-t { background-image: linear-gradient(to top, var(--tw-gradient-stops)); }
.from-red-900\/80 { --tw-gradient-from: rgb(127 29 29 / 0.8); }
.via-red-800\/40 { --tw-gradient-via: rgb(153 27 27 / 0.4); }
.to-transparent { --tw-gradient-to: transparent; }
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
├── IPM (untuk data pengurus)
└── Pengaturan IPM (untuk banner & panel)
```

### **Form Fields Description**

#### **IPM:**
- **Jabatan**: Posisi dalam organisasi IPM (contoh: "Ketua IPM", "Wakil Ketua")
- **Nama**: Nama lengkap pengurus
- **Foto**: Upload foto pengurus (rasio 3:4, ukuran 300x400px)
- **Kelas**: Kelas pengurus (contoh: "IX A", "VIII B")
- **Deskripsi**: Deskripsi jabatan (opsional)
- **Urutan**: Angka untuk mengatur urutan tampilan
- **Aktif**: Toggle untuk menampilkan/menyembunyikan

#### **Pengaturan IPM:**
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
storage/app/public/ipm/
├── banner_desktop.jpg
├── banner_mobile.jpg
├── ketua_ipm.jpg
├── wakil_ketua.jpg
├── sekretaris.jpg
└── ...
```

**File URLs:**
- Desktop Banner: `http://localhost:8000/storage/ipm/banner_desktop.jpg`
- Mobile Banner: `http://localhost:8000/storage/ipm/banner_mobile.jpg`
- Foto Pengurus: `http://localhost:8000/storage/ipm/{filename}.jpg`

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
# Get all IPM data
curl http://localhost:8000/api/v1/ipm

# Get settings
curl http://localhost:8000/api/v1/ipm/settings

# Get complete data
curl http://localhost:8000/api/v1/ipm/complete

# Get single data
curl http://localhost:8000/api/v1/ipm/1
```

### **JavaScript Fetch Examples**
```javascript
// Get complete data
fetch('http://localhost:8000/api/v1/ipm/complete')
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      console.log('Settings:', data.data.settings);
      console.log('Content:', data.data.content);
    }
  });

// Get single data
fetch('http://localhost:8000/api/v1/ipm/1')
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
3. **Image Uploads**: Foto pengurus disimpan di `storage/app/public/ipm/`
4. **Photo Ratio**: Foto pengurus menggunakan rasio 3:4 (portrait)
5. **Responsive Design**: Banner desktop dan mobile terpisah untuk responsive design
6. **Gradient Colors**: Menggunakan gradient merah untuk tema IPM
7. **Alternating Layout**: Layout foto dan teks bergantian (kiri-kanan, kanan-kiri)
8. **Class Information**: Menampilkan informasi kelas pengurus

---

**Dokumentasi API IPM selesai!** 🕌 
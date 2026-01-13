# 🏫 FASILITAS DINAMIS API DOCUMENTATION

## 📋 Overview
API untuk mengelola sistem fasilitas dinamis dengan sub-fasilitas yang dapat dikonfigurasi. Sistem ini memungkinkan pembuatan halaman sub-fasilitas secara dinamis berdasarkan konfigurasi facility box.

## 🔗 Base URL
```
http://localhost:8000/api/v1/facilities
```

---

## 📡 API Endpoints

### **1. Get Main Facility Page Data**
```http
GET /facilities
```

**Response:**
```json
{
  "success": true,
  "data": {
         "settings": {
       "id": 1,
       "title": "Fasilitas di Sekolah",
       "subtitle": "Terdapat beragam fasilitas yang tersebar di seluruh sekolah. Kami berkomitmen untuk menciptakan lingkungan belajar yang nyaman untuk seluruh siswa.",
       "banner_desktop": "http://localhost:8000/storage/facilities/banner_desktop.jpg",
       "banner_mobile": "http://localhost:8000/storage/facilities/banner_mobile.jpg",
       "title_panel_bg_color": "bg-green-400",
       "subtitle_panel_bg_color": "bg-blue-600",
       "is_active": true
     },
     "content": [
       {
         "id": 1,
         "section_title": "Fasilitas Unggulan Sekolah Kami",
         "content": "<p>Sekolah kami berkomitmen untuk menyediakan fasilitas terbaik guna mendukung proses pembelajaran yang berkualitas...</p>",
         "display_type": "wysiwyg",
         "show_photo_collage": true,
         "order_index": 1,
         "is_active": true
       }
     ],
     "photos": [
       {
         "id": 1,
         "title": "Ruang Kelas Modern",
         "description": "Ruang kelas dengan fasilitas teknologi terdepan",
         "image": "http://localhost:8000/storage/facilities/photos/main_classroom.jpg",
         "alt_text": "Ruang kelas modern dengan proyektor dan AC",
         "order_index": 1,
         "is_active": true
       },
       {
         "id": 2,
         "title": "Laboratorium Komputer",
         "description": "Lab komputer dengan perangkat terkini untuk pembelajaran IT",
         "image": "http://localhost:8000/storage/facilities/photos/computer_lab.jpg",
         "alt_text": "Laboratorium komputer dengan PC modern",
         "order_index": 2,
         "is_active": true
       }
     ],
    "boxes": [
      {
        "id": 1,
        "title": "Bookstore",
        "description": "Temukan berbagai buku terbaik sebagai sumber belajarmu dengan harga termurah.",
        "icon": "http://localhost:8000/storage/facilities/icons/bookstore.svg",
        "background_image": "http://localhost:8000/storage/facilities/backgrounds/bookstore.jpg",
        "link_slug": "bookstore",
        "bg_color": "bg-blue-600",
        "hover_bg_color": "bg-blue-700",
        "order_index": 1,
        "is_active": true,
        "creates_sub_facility": true
      },
      {
        "id": 2,
        "title": "Kantin",
        "description": "Nikmati berbagai kuliner di setiap kampus dengan harga terjangkau.",
        "icon": "http://localhost:8000/storage/facilities/icons/kantin.svg",
        "background_image": "http://localhost:8000/storage/facilities/backgrounds/kantin.jpg",
        "link_slug": "kantin",
        "bg_color": "bg-blue-600",
        "hover_bg_color": "bg-blue-700",
        "order_index": 2,
        "is_active": true,
        "creates_sub_facility": true
      }
    ],
    "facilities": [
      {
        "id": 1,
        "name": "Laboratorium Komputer",
        "slug": "laboratorium-komputer",
        "description": "Laboratorium komputer modern dengan perangkat terkini untuk mendukung pembelajaran teknologi informasi dan komunikasi.",
        "image": "http://localhost:8000/storage/facilities/lab_komputer.jpg",
        "category": "Akademik",
        "capacity": 40,
        "location": "Lantai 2, Gedung A",
        "specifications": {
          "komputer": "40 unit",
          "proyektor": "1 unit",
          "ac": "2 unit"
        },
        "order_index": 1
      }
    ]
  }
}
```

### **2. Get Facility Settings Only**
```http
GET /facilities/settings
```

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "title": "Fasilitas di Sekolah",
    "subtitle": "Terdapat beragam fasilitas yang tersebar di seluruh sekolah. Kami berkomitmen untuk menciptakan lingkungan belajar yang nyaman untuk seluruh siswa.",
    "banner_desktop": "http://localhost:8000/storage/facilities/banner_desktop.jpg",
    "banner_mobile": "http://localhost:8000/storage/facilities/banner_mobile.jpg",
    "title_panel_bg_color": "bg-green-400",
    "subtitle_panel_bg_color": "bg-blue-600",
    "is_active": true
  }
}
```

### **3. Get Facility Boxes Only**
```http
GET /facilities/boxes
```

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "title": "Bookstore",
      "description": "Temukan berbagai buku terbaik sebagai sumber belajarmu dengan harga termurah.",
      "icon": "http://localhost:8000/storage/facilities/icons/bookstore.svg",
      "background_image": "http://localhost:8000/storage/facilities/backgrounds/bookstore.jpg",
      "link_slug": "bookstore",
      "bg_color": "bg-blue-600",
      "hover_bg_color": "bg-blue-700",
      "order_index": 1,
      "is_active": true,
      "creates_sub_facility": true
    }
  ]
}
```

### **4. Get Single Facility**
```http
GET /facilities/{slug}
```

**Parameters:**
- `slug` (string) - Slug fasilitas

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "name": "Laboratorium Komputer",
    "slug": "laboratorium-komputer",
    "description": "Laboratorium komputer modern dengan perangkat terkini untuk mendukung pembelajaran teknologi informasi dan komunikasi.",
    "image": "http://localhost:8000/storage/facilities/lab_komputer.jpg",
    "category": "Akademik",
    "capacity": 40,
    "location": "Lantai 2, Gedung A",
    "specifications": {
      "komputer": "40 unit",
      "proyektor": "1 unit",
      "ac": "2 unit"
    },
    "order_index": 1
  }
}
```

### **5. Get Sub-Facility Data (Dynamic)**
```http
GET /facilities/sub/{parentSlug}
```

**Parameters:**
- `parentSlug` (string) - Slug dari facility box (contoh: ruangkelas, perpustakaan)

**Response:**
```json
{
  "success": true,
  "data": {
    "settings": {
      "id": 1,
      "parent_slug": "ruangkelas",
      "title": "Ruang Kelas di Sekolah",
      "subtitle": "Terdapat beragam ruang kelas yang tersebar di seluruh sekolah. Kami berkomitmen untuk menciptakan lingkungan belajar yang nyaman untuk seluruh siswa.",
      "banner_desktop": "http://localhost:8000/storage/sub-facilities/banners/ruangkelas_desktop.jpg",
      "banner_mobile": "http://localhost:8000/storage/sub-facilities/banners/ruangkelas_mobile.jpg",
      "title_panel_bg_color": "bg-yellow-400",
      "subtitle_panel_bg_color": "bg-blue-600",
      "content_section_title": "Setiap Sudut di Sekolah Adalah Ruang Sosial yang Nyaman",
      "content_section_text": "<p>Sekolah peduli dengan kenyamanan siswanya...</p>",
      "display_type": "grid",
      "show_photo_collage": true,
      "is_active": true
    },
           "boxes": [
         {
           "id": 1,
           "parent_slug": "ruangkelas",
           "title": "Teknologi Digital",
           "description": "Ruang kelas dilengkapi dengan teknologi digital terdepan untuk pembelajaran interaktif dan modern.",
           "icon": "http://localhost:8000/storage/sub-facilities/icons/teknologi.svg",
           "background_image": "http://localhost:8000/storage/sub-facilities/backgrounds/teknologi.jpg",
           "bg_color": "bg-blue-600",
           "hover_bg_color": "bg-blue-700",
           "order_index": 1,
           "is_active": true
         }
       ],
       "photos": [
         {
           "id": 1,
           "parent_slug": "ruangkelas",
           "title": "Ruang Kelas Modern 1",
           "description": "Ruang kelas dengan fasilitas modern dan teknologi terdepan",
           "image": "http://localhost:8000/storage/sub-facilities/photos/ruang_kelas_1.jpg",
           "alt_text": "Ruang kelas modern dengan proyektor dan AC",
           "order_index": 1,
           "is_active": true
         },
         {
           "id": 2,
           "parent_slug": "ruangkelas",
           "title": "Ruang Kelas Modern 2",
           "description": "Ruang kelas dengan pencahayaan alami yang optimal",
           "image": "http://localhost:8000/storage/sub-facilities/photos/ruang_kelas_2.jpg",
           "alt_text": "Ruang kelas dengan pencahayaan alami",
           "order_index": 2,
           "is_active": true
         }
       ],
    "facilities": [
      {
        "id": 1,
        "name": "Ruang Kelas A1",
        "slug": "ruang-kelas-a1",
        "description": "Ruang kelas modern dengan fasilitas AC dan proyektor untuk mendukung pembelajaran yang nyaman.",
        "image": "http://localhost:8000/storage/sub-facilities/kelas_a1.jpg",
        "category": "Ruang Kelas",
        "capacity": 30,
        "location": "Lantai 1, Gedung A",
        "specifications": {
          "ac": "2 unit",
          "proyektor": "1 unit",
          "papan_tulis": "1 unit"
        },
        "order_index": 1,
        "parent_slug": "ruangkelas"
      }
    ]
  }
}
```

### **6. Get Sub-Facility by Category**
```http
GET /facilities/sub/{parentSlug}/category/{category}
```

**Parameters:**
- `parentSlug` (string) - Slug dari facility box
- `category` (string) - Kategori sub-fasilitas

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Ruang Kelas A1",
      "slug": "ruang-kelas-a1",
      "description": "Ruang kelas modern dengan fasilitas AC dan proyektor untuk mendukung pembelajaran yang nyaman.",
      "image": "http://localhost:8000/storage/sub-facilities/kelas_a1.jpg",
      "category": "Ruang Kelas",
      "capacity": 30,
      "location": "Lantai 1, Gedung A",
      "specifications": {
        "ac": "2 unit",
        "proyektor": "1 unit",
        "papan_tulis": "1 unit"
      },
      "order_index": 1,
      "parent_slug": "ruangkelas"
    }
  ]
}
```

### **7. Get Single Sub-Facility**
```http
GET /facilities/sub/{parentSlug}/{slug}
```

**Parameters:**
- `parentSlug` (string) - Slug dari facility box
- `slug` (string) - Slug sub-fasilitas

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "name": "Ruang Kelas A1",
    "slug": "ruang-kelas-a1",
    "description": "Ruang kelas modern dengan fasilitas AC dan proyektor untuk mendukung pembelajaran yang nyaman.",
    "image": "http://localhost:8000/storage/sub-facilities/kelas_a1.jpg",
    "category": "Ruang Kelas",
    "capacity": 30,
    "location": "Lantai 1, Gedung A",
    "specifications": {
      "ac": "2 unit",
      "proyektor": "1 unit",
      "papan_tulis": "1 unit"
    },
    "order_index": 1,
    "parent_slug": "ruangkelas"
  }
}
```

---

## 🎨 Data Structure Details

### **Facility Settings**
| Field | Type | Description |
|-------|------|-------------|
| `title` | string | Judul halaman fasilitas |
| `subtitle` | text | Subtitle halaman |
| `banner_desktop` | string | URL banner desktop (nullable) |
| `banner_mobile` | string | URL banner mobile (nullable) |
| `title_panel_bg_color` | string | Warna background panel judul |
| `subtitle_panel_bg_color` | string | Warna background panel subtitle |
| `is_active` | boolean | Status aktif/nonaktif |

### **Facility Content**
| Field | Type | Description |
|-------|------|-------------|
| `section_title` | string | Judul section content |
| `content` | longText | Konten deskripsi fasilitas (Rich Text) |
| `display_type` | string | Tipe tampilan (wysiwyg/simple_text/grid) |
| `show_photo_collage` | boolean | Tampilkan photo collage setelah content |
| `order_index` | integer | Urutan tampilan |
| `is_active` | boolean | Status aktif/nonaktif |

### **Facility Photo**
| Field | Type | Description |
|-------|------|-------------|
| `title` | string | Judul foto |
| `description` | text | Deskripsi foto (nullable) |
| `image` | string | URL foto |
| `alt_text` | string | Alt text untuk SEO (nullable) |
| `order_index` | integer | Urutan tampilan |
| `is_active` | boolean | Status aktif/nonaktif |

### **Facility Box**
| Field | Type | Description |
|-------|------|-------------|
| `title` | string | Judul box |
| `description` | text | Deskripsi box |
| `icon` | string | URL icon (nullable) |
| `background_image` | string | URL gambar background (nullable) |
| `link_slug` | string | Slug untuk membuat sub-fasilitas |
| `bg_color` | string | Warna background box |
| `hover_bg_color` | string | Warna background hover |
| `order_index` | integer | Urutan tampilan |
| `is_active` | boolean | Status aktif/nonaktif |
| `creates_sub_facility` | boolean | Apakah box ini membuat sub-fasilitas |

### **Sub Facility**
| Field | Type | Description |
|-------|------|-------------|
| `name` | string | Nama fasilitas |
| `slug` | string | Slug fasilitas (auto-generated) |
| `description` | text | Deskripsi fasilitas |
| `image` | string | URL gambar (nullable) |
| `category` | string | Kategori fasilitas |
| `capacity` | integer | Kapasitas fasilitas |
| `location` | string | Lokasi fasilitas |
| `specifications` | json | Spesifikasi fasilitas |
| `order_index` | integer | Urutan tampilan |
| `is_active` | boolean | Status aktif/nonaktif |
| `parent_slug` | string | Slug dari facility box |

### **Sub Facility Settings**
| Field | Type | Description |
|-------|------|-------------|
| `parent_slug` | string | Slug dari facility box |
| `title` | string | Judul halaman sub-fasilitas |
| `subtitle` | text | Subtitle halaman |
| `banner_desktop` | string | URL banner desktop (nullable) |
| `banner_mobile` | string | URL banner mobile (nullable) |
| `title_panel_bg_color` | string | Warna background panel judul |
| `subtitle_panel_bg_color` | string | Warna background panel subtitle |
| `content_section_title` | text | Judul section content |
| `content_section_text` | longText | Text content section |
| `display_type` | string | Tipe tampilan (grid/list/gallery) |
| `show_photo_collage` | boolean | Tampilkan photo collage |
| `is_active` | boolean | Status aktif/nonaktif |

### **Sub Facility Box**
| Field | Type | Description |
|-------|------|-------------|
| `parent_slug` | string | Slug dari facility box |
| `title` | string | Judul box |
| `description` | text | Deskripsi box |
| `icon` | string | URL icon (nullable) |
| `background_image` | string | URL gambar background (nullable) |
| `bg_color` | string | Warna background box |
| `hover_bg_color` | string | Warna background hover |
| `order_index` | integer | Urutan tampilan |
| `is_active` | boolean | Status aktif/nonaktif |

### **Sub Facility Photo**
| Field | Type | Description |
|-------|------|-------------|
| `parent_slug` | string | Slug dari facility box |
| `title` | string | Judul foto |
| `description` | text | Deskripsi foto (nullable) |
| `image` | string | URL foto |
| `alt_text` | string | Alt text untuk SEO (nullable) |
| `order_index` | integer | Urutan tampilan |
| `is_active` | boolean | Status aktif/nonaktif |

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
Fasilitas
├── Fasilitas (untuk data fasilitas utama)
├── Pengaturan Fasilitas (untuk banner & panel utama)
├── Fasilitas Content (untuk konten/deskripsi fasilitas)
├── Photo Collage Fasilitas (untuk foto-foto halaman utama)
├── Fasilitas Box (untuk 6 box utama)
├── Sub Fasilitas (untuk data sub-fasilitas)
├── Pengaturan Sub Fasilitas (untuk pengaturan sub-fasilitas)
├── Sub Fasilitas Box (untuk box sub-fasilitas)
└── Photo Collage Sub Fasilitas (untuk foto-foto photo collage)
```

### **Workflow Konfigurasi**

#### **1. Setup Facility Box dengan Sub-Facility**
1. Buka **Fasilitas Box**
2. Buat box baru dengan:
   - **Judul Box**: "Ruang Kelas"
   - **Link Slug**: "ruangkelas"
   - **Membuat Sub-Fasilitas**: ✅ Aktifkan
3. Simpan box

#### **2. Setup Sub-Facility Settings**
1. Buka **Pengaturan Sub Fasilitas**
2. Buat pengaturan baru dengan:
   - **Parent Slug**: "ruangkelas"
   - **Judul Halaman**: "Ruang Kelas di Sekolah"
   - **Subtitle**: "Terdapat beragam ruang kelas..."
   - **Banner Desktop/Mobile**: Upload banner
   - **Content Section Title**: "Setiap Sudut di Sekolah..."
   - **Content Section Text**: Rich text content
   - **Tipe Tampilan**: "grid"
   - **Tampilkan Photo Collage**: ✅ Aktifkan

#### **3. Setup Sub-Facility Boxes**
1. Buka **Sub Fasilitas Box**
2. Buat box-box untuk sub-fasilitas dengan:
   - **Parent Slug**: "ruangkelas"
   - **Judul Box**: "Teknologi Digital"
   - **Deskripsi**: "Ruang kelas dilengkapi..."
   - **Icon & Background Image**: Upload gambar

#### **4. Setup Sub-Facility Data**
1. Buka **Sub Fasilitas**
2. Buat data fasilitas dengan:
   - **Nama Fasilitas**: "Ruang Kelas A1"
   - **Parent Slug**: "ruangkelas"
   - **Deskripsi**: "Ruang kelas modern..."
   - **Kategori**: "Ruang Kelas"
   - **Kapasitas**: 30
   - **Lokasi**: "Lantai 1, Gedung A"
   - **Spesifikasi**: JSON data

---

## 🔧 Frontend Integration Example

### **Main Facility Page**
```javascript
// Fetch main facility data
fetch('http://localhost:8000/api/v1/facilities')
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      const { settings, content, photos, boxes, facilities } = data.data;
      
      // Render banner with settings
      renderBanner(settings);
      
      // Render content sections
      content.forEach(section => {
        renderContentSection(section);
        
        // Render photo collage if enabled for this section
        if (section.show_photo_collage && photos.length > 0) {
          renderPhotoCollage(photos);
        }
      });
      
      // Render 6 boxes
      renderFacilityBoxes(boxes);
      
      // Render facilities grid
      renderFacilitiesGrid(facilities);
    }
  });
```

### **Dynamic Sub-Facility Page**
```javascript
// Fetch sub-facility data based on parentSlug
function loadSubFacility(parentSlug) {
  fetch(`http://localhost:8000/api/v1/facilities/sub/${parentSlug}`)
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        const { settings, boxes, facilities } = data.data;
        
        // Render banner with sub-facility settings
        renderSubFacilityBanner(settings);
        
        // Render content section
        renderContentSection(settings);
        
        // Render photo collage if enabled
        if (settings.show_photo_collage) {
          renderPhotoCollage();
        }
        
                 // Render sub-facility boxes
         renderSubFacilityBoxes(boxes);
         
         // Render photo collage if enabled and photos available
         if (settings.show_photo_collage && photos.length > 0) {
           renderPhotoCollage(photos);
         }
         
         // Render facilities with display type
         renderFacilitiesWithType(facilities, settings.display_type);
      }
    });
}

// Example usage
 loadSubFacility('ruangkelas'); // Loads /fasilitas/ruangkelas
 loadSubFacility('perpustakaan'); // Loads /fasilitas/perpustakaan
 ```

### **Photo Collage Implementation Example**
```javascript
function renderPhotoCollage(photos) {
  const photoCollageHtml = `
    <section id="photo-collage-3" className="bg-gray-50 py-8">
      <div className="container mx-auto px-4">
        <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
          ${photos.map(photo => `
            <div className="relative">
              <img 
                alt="${photo.alt_text || photo.title}"
                src="${photo.image}"
                className="w-full h-72 object-cover rounded-lg shadow-md"
                title="${photo.title}"
              />
              ${photo.description ? `
                <div className="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white p-4 rounded-b-lg">
                  <h3 className="font-semibold">${photo.title}</h3>
                  <p className="text-sm">${photo.description}</p>
                </div>
              ` : ''}
            </div>
          `).join('')}
        </div>
      </div>
    </section>
  `;
  
  document.getElementById('photo-collage-container').innerHTML = photoCollageHtml;
}
```

---

## 📁 File Storage Structure

```
storage/app/public/
├── facilities/
│   ├── banner_desktop.jpg
│   ├── banner_mobile.jpg
│   ├── lab_komputer.jpg
│   ├── icons/
│   │   ├── bookstore.svg
│   │   └── kantin.svg
│   └── backgrounds/
│       ├── bookstore.jpg
│       └── kantin.jpg
└── sub-facilities/
    ├── banners/
    │   ├── ruangkelas_desktop.jpg
    │   ├── ruangkelas_mobile.jpg
    │   ├── perpustakaan_desktop.jpg
    │   └── perpustakaan_mobile.jpg
    ├── icons/
    │   ├── teknologi.svg
    │   └── smart_classroom.svg
         ├── backgrounds/
     │   ├── teknologi.jpg
     │   └── smart_classroom.jpg
     ├── photos/
     │   ├── ruang_kelas_1.jpg
     │   ├── ruang_kelas_2.jpg
     │   ├── ruang_multimedia.jpg
     │   └── lab_digital.jpg
     └── kelas_a1.jpg
```

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
// Sub-facility not found
{
  "success": false,
  "message": "Sub-facility not found"
}

// Settings not found
{
  "success": false,
  "message": "Facility settings not found"
}
```

---

## 🔍 Testing Examples

### **cURL Commands**
```bash
# Get main facility data
curl http://localhost:8000/api/v1/facilities

# Get facility settings
curl http://localhost:8000/api/v1/facilities/settings

# Get facility boxes
curl http://localhost:8000/api/v1/facilities/boxes

# Get sub-facility data
curl http://localhost:8000/api/v1/facilities/sub/ruangkelas

# Get sub-facility by category
curl http://localhost:8000/api/v1/facilities/sub/ruangkelas/category/Ruang%20Kelas

# Get single sub-facility
curl http://localhost:8000/api/v1/facilities/sub/ruangkelas/ruang-kelas-a1
```

### **JavaScript Fetch Examples**
```javascript
// Get main facility data
fetch('http://localhost:8000/api/v1/facilities')
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      console.log('Settings:', data.data.settings);
      console.log('Boxes:', data.data.boxes);
      console.log('Facilities:', data.data.facilities);
    }
  });

// Get sub-facility data
fetch('http://localhost:8000/api/v1/facilities/sub/ruangkelas')
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      console.log('Sub-facility settings:', data.data.settings);
      console.log('Sub-facility boxes:', data.data.boxes);
      console.log('Sub-facility facilities:', data.data.facilities);
    }
  });
```

---

## 📝 Notes

1. **Dynamic Sub-Facilities**: Sub-fasilitas dibuat secara dinamis berdasarkan konfigurasi facility box
2. **Parent-Child Relationship**: Semua sub-fasilitas terkait dengan facility box melalui `parent_slug`
3. **Flexible Display**: Sub-fasilitas mendukung berbagai tipe tampilan (grid, list, gallery)
4. **Photo Collage**: Fitur photo collage dapat diaktifkan/nonaktifkan per sub-fasilitas
5. **Rich Content**: Content section mendukung rich text editor
6. **Responsive Banners**: Banner desktop dan mobile terpisah untuk responsive design
7. **Order Management**: Semua data dapat diurutkan menggunakan `order_index`
8. **Active Status**: Hanya data dengan `is_active = true` yang dikembalikan
9. **File Management**: Gambar dan icon dikelola dengan struktur folder yang terorganisir
10. **Slug Generation**: Slug dibuat otomatis dari nama menggunakan Spatie Sluggable

---

**Dokumentasi API Fasilitas Dinamis selesai!** 🏫 
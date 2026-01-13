# API Endpoints untuk Frontend - Manajemen Data Guru

## Base URL
```
http://localhost:8000/api/v1
```

## 📋 Daftar Endpoints

### 1. **Get Teachers Grouped by Subject** ⭐ (Rekomendasi untuk frontend)
```
GET /teachers/by-subject
```

**Response:**
```json
{
  "data": {
    "matematika": [
      {
        "name": "Dr. Ahmad Susanto, M.Pd.",
        "image": "http://localhost:8000/storage/teachers/ahmad.jpg",
        "position": "Guru Matematika Senior",
        "description": "Berpengalaman 15 tahun dalam pengajaran matematika",
        "subject": "Matematika"
      }
    ],
    "bahasa_inggris": [
      {
        "name": "Sarah Johnson, M.A.",
        "image": "http://localhost:8000/storage/teachers/sarah.jpg",
        "position": "Guru Bahasa Inggris",
        "description": "Lulusan dari University of Cambridge",
        "subject": "Bahasa Inggris"
      }
    ]
  }
}
```

### 2. **Get All Teachers & Staff**
```
GET /teachers
```

**Response:**
```json
{
  "data": [
    {
      "id": 1,
      "name": "Dr. Ahmad Susanto",
      "subject": "Matematika",
      "photo": "teachers/ahmad.jpg",
      "bio": "Berpengalaman 15 tahun...",
      "position": "Guru Matematika Senior",
      "education": "S2 Pendidikan Matematika",
      "experience": "15 tahun mengajar",
      "type": "teacher",
      "order_index": 1,
      "is_active": true
    }
  ]
}
```

### 3. **Get Teachers Only**
```
GET /teachers/list
```

**Response:** Same format as `/teachers` but filtered for teachers only

### 4. **Get Staff Only**
```
GET /staff/list
```

**Response:** Same format as `/teachers` but filtered for staff only

## Navigation & Branding
- GET `/api/v1/navigation/header`
  - Response:
    - `menu`: daftar item navbar (top level) beserta `dropdown`
    - `branding.header_logo`: URL/path logo header (nullable)
- GET `/api/v1/navigation/footer`
  - Response:
    - `links.menu-utama|informasi-akademik|sosial|lainnya`: array link
    - `branding.footer_brand_type`: `text|image`
    - `branding.footer_brand_text`: teks (nullable)
    - `branding.footer_brand_image`: URL/path (nullable)

## 🎯 Usage di Frontend

### Contoh Penggunaan dengan JavaScript/TypeScript

```typescript
// API Service
const API_BASE_URL = 'http://localhost:8000/api/v1';

// Get teachers grouped by subject (recommended)
export const getTeachersBySubject = async () => {
  const response = await fetch(`${API_BASE_URL}/teachers/by-subject`);
  const data = await response.json();
  return data.data; // Returns object with subjects as keys
};

// Get all teachers
export const getAllTeachers = async () => {
  const response = await fetch(`${API_BASE_URL}/teachers`);
  const data = await response.json();
  return data.data;
};

// Get teachers only
export const getTeachersOnly = async () => {
  const response = await fetch(`${API_BASE_URL}/teachers/list`);
  const data = await response.json();
  return data.data;
};

// Get staff only
export const getStaffOnly = async () => {
  const response = await fetch(`${API_BASE_URL}/staff/list`);
  const data = await response.json();
  return data.data;
};
```

### Contoh Penggunaan di React Component

```typescript
// Contoh penggunaan endpoint by-subject
const [teachersBySubject, setTeachersBySubject] = useState({});

useEffect(() => {
  fetch('http://localhost:8000/api/v1/teachers/by-subject')
    .then(res => res.json())
    .then(data => setTeachersBySubject(data.data));
}, []);

// Data yang didapat:
// teachersBySubject = {
//   "matematika": [...],
//   "bahasa_inggris": [...],
//   ...
// }
```

## 🔧 Environment Variables

Tambahkan ke `.env.local` frontend:
```
NEXT_PUBLIC_API_URL=http://localhost:8000/api/v1
```

## ⚠️ Catatan Penting

1. **CORS**: Backend sudah dikonfigurasi untuk menerima request dari frontend
2. **Image URLs**: Semua URL gambar sudah lengkap dengan base URL
3. **Data Dinamis**: Subject dan position sekarang bisa diisi bebas di Filament
4. **Format Key**: Subject otomatis dikonversi ke lowercase dengan underscore ("Bahasa Inggris" → "bahasa_inggris")

## 📱 Contoh Response Lengkap

### Request:
```
GET http://localhost:8000/api/v1/teachers/by-subject
```

### Response Lengkap:
```json
{
  "data": {
    "matematika": [
      {
        "name": "Dr. Ahmad Susanto, M.Pd.",
        "image": "http://localhost:8000/storage/teachers/photo1.jpg",
        "position": "Guru Matematika Senior",
        "description": "Berpengalaman 15 tahun dalam pengajaran matematika dengan spesialisasi kalkulus dan aljabar",
        "subject": "Matematika"
      }
    ],
    "bahasa_indonesia": [
      {
        "name": "Prof. Bambang Sutrisno, M.Pd.",
        "image": "http://localhost:8000/storage/teachers/photo2.jpg",
        "position": "Guru Bahasa Indonesia Senior",
        "description": "Ahli dalam sastra Indonesia dan pengembangan kurikulum bahasa",
        "subject": "Bahasa Indonesia"
      }
    ],
    "kimia": [
      {
        "name": "Dr. Citra Pratiwi, M.Si",
        "image": "http://localhost:8000/storage/teachers/photo3.jpg",
        "position": "Kepala Laboratorium Kimia",
        "description": "Spesialis kimia organik dan anorganik dengan pengalaman penelitian",
        "subject": "Kimia"
      }
    ]
  }
}
```
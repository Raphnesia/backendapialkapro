# 📚 Dokumentasi API Frontend - Sekolah

## 🎯 Overview
Dokumentasi lengkap untuk integrasi frontend dengan backend API sekolah, termasuk endpoint baru untuk Tapak Suci, Hisbul Wathan, dan Prestasi.

---

## 🏛️ **1. TAPAK SUCI** (`/profil/tapak-suci`)

### **Endpoint Utama**
```
GET /api/v1/tapak-suci
GET /api/v1/tapak-suci/complete
GET /api/v1/tapak-suci/settings
GET /api/v1/tapak-suci/{id}
```

### **1.1 Settings (Pengaturan)**
```typescript
// GET /api/v1/tapak-suci/settings
interface TapakSuciSettings {
  hero_title: string;
  hero_subtitle: string;
  hero_background_color: string;
  hero_text_color: string;
  is_active: boolean;
}
```

**Response Example:**
```json
{
  "hero_title": "Tapak Suci",
  "hero_subtitle": "Pencak Silat Muhammadiyah",
  "hero_background_color": "#1e40af",
  "hero_text_color": "#ffffff",
  "is_active": true
}
```

### **1.2 Content (Konten)**
```typescript
// GET /api/v1/tapak-suci
interface TapakSuciContent {
  id: number;
  title: string;
  content: string;
  image?: string;
  created_at: string;
  updated_at: string;
}
```

**Response Example:**
```json
[
  {
    "id": 1,
    "title": "Sejarah Tapak Suci",
    "content": "Tapak Suci adalah organisasi pencak silat...",
    "image": "https://api.raphnesia.my.id/storage/1/tapak-suci.jpg",
    "created_at": "2024-12-19T10:00:00.000000Z",
    "updated_at": "2024-12-19T10:00:00.000000Z"
  }
]
```

### **1.3 Complete Data**
```typescript
// GET /api/v1/tapak-suci/complete
interface TapakSuciComplete {
  settings: TapakSuciSettings;
  content: TapakSuciContent[];
}
```

---

## 🏃‍♂️ **2. HISBUL WATHAN** (`/profil/hisbul-wathan`)

### **Endpoint Utama**
```
GET /api/v1/hisbul-wathan
GET /api/v1/hisbul-wathan/complete
GET /api/v1/hisbul-wathan/settings
GET /api/v1/hisbul-wathan/{id}
```

### **2.1 Settings (Pengaturan)**
```typescript
// GET /api/v1/hisbul-wathan/settings
interface HisbulWathanSettings {
  hero_title: string;
  hero_subtitle: string;
  hero_background_color: string;
  hero_text_color: string;
  is_active: boolean;
}
```

**Response Example:**
```json
{
  "hero_title": "Hisbul Wathan",
  "hero_subtitle": "Kepanduan Muhammadiyah",
  "hero_background_color": "#059669",
  "hero_text_color": "#ffffff",
  "is_active": true
}
```

### **2.2 Content (Konten)**
```typescript
// GET /api/v1/hisbul-wathan
interface HisbulWathanContent {
  id: number;
  title: string;
  content: string;
  image?: string;
  created_at: string;
  updated_at: string;
}
```

### **2.3 Complete Data**
```typescript
// GET /api/v1/hisbul-wathan/complete
interface HisbulWathanComplete {
  settings: HisbulWathanSettings;
  content: HisbulWathanContent[];
}
```

---

## 🏆 **3. PRESTASI** (`/prestasi`)

### **Endpoint Utama**
```
GET /api/v1/prestasi/settings
GET /api/v1/prestasi/right-image
GET /api/v1/prestasi/list
GET /api/v1/prestasi/tahfidz
GET /api/v1/prestasi/complete
```

### **3.1 Settings (Pengaturan)**
```typescript
// GET /api/v1/prestasi/settings
interface PrestasiSettings {
  main_heading: string;
  hero_background_color: string;
  hero_text_color: string;
}
```

**Response Example:**
```json
{
  "main_heading": "Prestasi Sekolah",
  "hero_background_color": "#1e40af",
  "hero_text_color": "#ffffff"
}
```

### **3.2 Right Image (Gambar Kanan)**
```typescript
// GET /api/v1/prestasi/right-image
interface PrestasiRightImage {
  id: number;
  title: string;
  excerpt: string;
  image: string;
  published_at: string;
}
```

**Response Example:**
```json
{
  "id": 15,
  "title": "Juara 1 Olimpiade Sains",
  "excerpt": "Siswa SMP Muhammadiyah Al Kautsar berhasil...",
  "image": "https://api.raphnesia.my.id/storage/15/olimpiade.jpg",
  "published_at": "2024-12-19T10:00:00.000000Z"
}
```

### **3.3 List Prestasi**
```typescript
// GET /api/v1/prestasi/list
interface PrestasiListResponse {
  data: PrestasiPost[];
  pagination: {
    current_page: number;
    last_page: number;
    per_page: number;
    total: number;
  };
}

interface PrestasiPost {
  id: number;
  title: string;
  excerpt: string;
  image: string;
  published_at: string;
  tags: string[];
}
```

**Response Example:**
```json
{
  "data": [
    {
      "id": 15,
      "title": "Juara 1 Olimpiade Sains",
      "excerpt": "Siswa SMP Muhammadiyah Al Kautsar...",
      "image": "https://api.raphnesia.my.id/storage/15/olimpiade.jpg",
      "published_at": "2024-12-19T10:00:00.000000Z",
      "tags": ["prestasi", "akademik"]
    }
  ],
  "pagination": {
    "current_page": 1,
    "last_page": 3,
    "per_page": 10,
    "total": 25
  }
}
```

### **3.4 List Tahfidz**
```typescript
// GET /api/v1/prestasi/tahfidz
interface TahfidzListResponse {
  data: TahfidzPost[];
  pagination: {
    current_page: number;
    last_page: number;
    per_page: number;
    total: number;
  };
}

interface TahfidzPost {
  id: number;
  title: string;
  excerpt: string;
  image: string;
  published_at: string;
  tags: string[];
}
```

### **3.5 Complete Data**
```typescript
// GET /api/v1/prestasi/complete
interface PrestasiComplete {
  settings: PrestasiSettings;
  right_image: PrestasiRightImage | null;
  prestasi_list: PrestasiPost[];
  tahfidz_list: TahfidzPost[];
}
```

---

## 🔧 **4. IMPLEMENTASI FRONTEND**

### **4.1 Next.js API Client**
```typescript
// lib/api.ts
const API_BASE = 'https://api.raphnesia.my.id/api/v1';

export const apiClient = {
  // Tapak Suci
  getTapakSuciSettings: () => 
    fetch(`${API_BASE}/tapak-suci/settings`).then(res => res.json()),
  
  getTapakSuciContent: () => 
    fetch(`${API_BASE}/tapak-suci`).then(res => res.json()),
  
  getTapakSuciComplete: () => 
    fetch(`${API_BASE}/tapak-suci/complete`).then(res => res.json()),

  // Hisbul Wathan
  getHisbulWathanSettings: () => 
    fetch(`${API_BASE}/hisbul-wathan/settings`).then(res => res.json()),
  
  getHisbulWathanContent: () => 
    fetch(`${API_BASE}/hisbul-wathan`).then(res => res.json()),
  
  getHisbulWathanComplete: () => 
    fetch(`${API_BASE}/hisbul-wathan/complete`).then(res => res.json()),

  // Prestasi
  getPrestasiSettings: () => 
    fetch(`${API_BASE}/prestasi/settings`).then(res => res.json()),
  
  getPrestasiRightImage: () => 
    fetch(`${API_BASE}/prestasi/right-image`).then(res => res.json()),
  
  getPrestasiList: (page = 1) => 
    fetch(`${API_BASE}/prestasi/list?page=${page}`).then(res => res.json()),
  
  getTahfidzList: (page = 1) => 
    fetch(`${API_BASE}/prestasi/tahfidz?page=${page}`).then(res => res.json()),
  
  getPrestasiComplete: () => 
    fetch(`${API_BASE}/prestasi/complete`).then(res => res.json()),
};
```

### **4.2 React Hook untuk Data Fetching**
```typescript
// hooks/usePrestasi.ts
import { useState, useEffect } from 'react';
import { apiClient } from '@/lib/api';

export const usePrestasi = () => {
  const [data, setData] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchData = async () => {
      try {
        setLoading(true);
        const result = await apiClient.getPrestasiComplete();
        setData(result);
      } catch (err) {
        setError(err);
      } finally {
        setLoading(false);
      }
    };

    fetchData();
  }, []);

  return { data, loading, error };
};
```

### **4.3 Contoh Penggunaan di Component**
```typescript
// components/PrestasiHero.tsx
import { usePrestasi } from '@/hooks/usePrestasi';

export const PrestasiHero = () => {
  const { data, loading, error } = usePrestasi();

  if (loading) return <div>Loading...</div>;
  if (error) return <div>Error loading data</div>;
  if (!data) return null;

  const { settings } = data;

  return (
    <div 
      className="hero-section"
      style={{ 
        backgroundColor: settings.hero_background_color,
        color: settings.hero_text_color 
      }}
    >
      <h1>{settings.main_heading}</h1>
    </div>
  );
};
```

---

## 📱 **5. RESPONSIVE DESIGN**

### **5.1 Hero Section Mobile**
```typescript
// Pastikan hero section responsive
const HeroSection = ({ settings, isMobile }) => (
  <div 
    className={`hero ${isMobile ? 'hero-mobile' : 'hero-desktop'}`}
    style={{ 
      backgroundColor: settings.hero_background_color,
      color: settings.hero_text_color 
    }}
  >
    <h1 className={isMobile ? 'text-2xl' : 'text-4xl'}>
      {settings.main_heading}
    </h1>
    <p className={isMobile ? 'text-sm' : 'text-lg'}>
      {settings.hero_subtitle}
    </p>
  </div>
);
```

### **5.2 Image Overlay Responsive**
```typescript
// Image dengan overlay yang responsive
const ImageWithOverlay = ({ image, title, subtitle, isMobile }) => (
  <div className="relative">
    <img 
      src={image} 
      alt={title}
      className={isMobile ? 'w-full h-48' : 'w-full h-96'}
    />
    <div className="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
      <div className="text-center text-white">
        <h2 className={isMobile ? 'text-xl' : 'text-3xl'}>{title}</h2>
        <p className={isMobile ? 'text-sm' : 'text-lg'}>{subtitle}</p>
      </div>
    </div>
  </div>
);
```

---

## 🚀 **6. DEPLOYMENT & TESTING**

### **6.1 Test API Endpoints**
```bash
# Test Tapak Suci
curl "https://api.raphnesia.my.id/api/v1/tapak-suci/settings"
curl "https://api.raphnesia.my.id/api/v1/tapak-suci/complete"

# Test Hisbul Wathan
curl "https://api.raphnesia.my.id/api/v1/hisbul-wathan/settings"
curl "https://api.raphnesia.my.id/api/v1/hisbul-wathan/complete"

# Test Prestasi
curl "https://api.raphnesia.my.id/api/v1/prestasi/settings"
curl "https://api.raphnesia.my.id/api/v1/prestasi/complete"
```

### **6.2 Error Handling**
```typescript
// Handle API errors gracefully
const handleApiError = (error: any) => {
  if (error.status === 404) {
    return 'Data tidak ditemukan';
  }
  if (error.status === 500) {
    return 'Server error, coba lagi nanti';
  }
  return 'Terjadi kesalahan';
};

// Gunakan di component
const { data, loading, error } = usePrestasi();

if (error) {
  return (
    <div className="error-message">
      {handleApiError(error)}
    </div>
  );
}
```

---

## 📋 **7. CHECKLIST IMPLEMENTASI**

### **Frontend Setup**
- [ ] Install dependencies (axios/fetch)
- [ ] Setup API client
- [ ] Create custom hooks
- [ ] Setup error handling
- [ ] Setup loading states

### **Components**
- [ ] Tapak Suci Hero Section
- [ ] Tapak Suci Content List
- [ ] Hisbul Wathan Hero Section
- [ ] Hisbul Wathan Content List
- [ ] Prestasi Hero Section
- [ ] Prestasi Right Image
- [ ] Prestasi List
- [ ] Tahfidz List

### **Pages**
- [ ] `/profil/tapak-suci`
- [ ] `/profil/hisbul-wathan`
- [ ] `/prestasi`

### **Testing**
- [ ] Test semua API endpoints
- [ ] Test responsive design
- [ ] Test error handling
- [ ] Test loading states

---

## 🔗 **8. LINKS & REFERENCES**

- **Backend API**: `https://api.raphnesia.my.id/api/v1`
- **Admin Dashboard**: `https://api.raphnesia.my.id/admin`
- **Documentation**: File ini
- **Git Repository**: `Raphnesia/backendapischool`

---

## 📞 **9. SUPPORT**

Jika ada masalah atau pertanyaan:
1. Cek API response dengan curl
2. Cek browser console untuk error
3. Cek network tab untuk request/response
4. Hubungi backend developer

---

**🎉 Selamat mengintegrasikan! Semua endpoint sudah siap dan siap digunakan.** 
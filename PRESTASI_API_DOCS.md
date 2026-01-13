# 🏆 API Dokumentasi Prestasi - Frontend Integration

## 📍 Base URL
```
<<<<<<< HEAD
https://api.alkapro.id/api/v1
=======
https://api.raphnesia.my.id/api/v1
>>>>>>> 01cf9e1bd0b1c9f8e46d93c6fdb38a4008df2eeb
```

## 🔐 Authentication
Semua endpoint **PUBLIC** (tidak memerlukan authentication).

---

## 🎯 **ENDPOINT UTAMA**

### **GET `/prestasi`**
Mengambil **SEMUA** data Prestasi dalam satu request (recommended untuk halaman utama).

**Response:**
```json
{
  "settings": {
    "main_heading": "Prestasi Sekolah",
    "hero_subtitle": "Siswa berprestasi dengan pencapaian luar biasa dan aktivasi instan bikin prestasi akademik dan non-akademik siap jalan bebas hambatan",
    "hero_background_color": "#1e40af",
    "hero_text_color": "#ffffff",
    "floating_elements_bg_color": "#fbbf24",
    "floating_elements_text_color": "#ffffff",
    "feature_lists": ["Prestasi Akademik Tinggi", "Juara Olimpiade Nasional", "Prestasi up to 150+ Penghargaan", "Pengembangan Bakat Terpadu"]
  },
  "right_image": {
    "id": 1,
    "title": "Juara 1 Olimpiade Sains Nasional",
<<<<<<< HEAD
    "featured_image": "https://api.alkapro.id/storage/1/olimpiade.jpg",
=======
    "featured_image": "https://api.raphnesia.my.id/storage/1/olimpiade.jpg",
>>>>>>> 01cf9e1bd0b1c9f8e46d93c6fdb38a4008df2eeb
    "excerpt": "Siswa SMP Muhammadiyah Al Kautsar berhasil...",
    "published_at": "2024-12-19T10:00:00.000000Z"
  },
  "list_prestasi": [
    {
      "id": 1,
      "title": "Juara 1 Lomba Matematika",
<<<<<<< HEAD
      "featured_image": "https://api.alkapro.id/storage/1/matematika.jpg",
=======
      "featured_image": "https://api.raphnesia.my.id/storage/1/matematika.jpg",
>>>>>>> 01cf9e1bd0b1c9f8e46d93c6fdb38a4008df2eeb
      "excerpt": "Siswa berhasil meraih juara...",
      "published_at": "2024-12-19T10:00:00.000000Z"
    }
  ],
  "list_tahfidz": [
    {
      "id": 2,
      "title": "Ujian Tahfidz Sekali Duduk",
<<<<<<< HEAD
      "featured_image": "https://api.alkapro.id/storage/2/tahfidz.jpg",
=======
      "featured_image": "https://api.raphnesia.my.id/storage/2/tahfidz.jpg",
>>>>>>> 01cf9e1bd0b1c9f8e46d93c6fdb38a4008df2eeb
      "excerpt": "Siswa berhasil menghafal 30 juz...",
      "published_at": "2024-12-19T10:00:00.000000Z"
    }
  ]
}
```

---

## 🔧 **ENDPOINT INDIVIDUAL**

### **1. Settings (Pengaturan)**
```http
GET /prestasi/settings
```

**Response:**
```json
{
  "main_heading": "Prestasi Sekolah",
  "hero_subtitle": "Siswa berprestasi dengan pencapaian luar biasa dan aktivasi instan bikin prestasi akademik dan non-akademik siap jalan bebas hambatan",
  "hero_background_color": "#1e40af",
  "hero_text_color": "#ffffff",
  "floating_elements_bg_color": "#fbbf24",
  "floating_elements_text_color": "#ffffff",
  "feature_lists": ["Prestasi Akademik Tinggi", "Juara Olimpiade Nasional", "Prestasi up to 150+ Penghargaan", "Pengembangan Bakat Terpadu"]
}
```

**Field Description:**
- `main_heading`: Judul utama halaman (contoh: "Prestasi Sekolah")
- `hero_subtitle`: Subtitle paragraf dibawah main heading
- `hero_background_color`: Warna background hero section
- `hero_text_color`: Warna teks hero section
- `floating_elements_bg_color`: Warna background floating elements
- `floating_elements_text_color`: Warna teks floating elements
- `feature_lists`: Array 4 item untuk feature checklist (kiri-kanan)

### **2. Right Image (Gambar Kanan)**
```http
GET /prestasi/right-image
```

**Response:** Berita dengan tag "prestasi" yang paling baru (untuk gambar kanan hero section).

### **3. List Prestasi**
```http
GET /prestasi/list-prestasi
```

**Response:** Array berita dengan tag "prestasi" (untuk section "Prestasi List").

### **4. List Tahfidz**
```http
GET /prestasi/list-tahfidz
```

**Response:** Array berita dengan tag "ujian tahfidz" (untuk section "Prestasi Ujian Tahfidz Sekali Duduk").

---

## 📱 **FRONTEND IMPLEMENTASI**

### **TypeScript Types**
```typescript
interface PrestasiSettings {
  main_heading: string;
  hero_subtitle: string;
  hero_background_color: string;
  hero_text_color: string;
  floating_elements_bg_color: string;
  floating_elements_text_color: string;
  feature_lists: string[];
}

interface PrestasiPost {
  id: number;
  title: string;
  featured_image: string;
  excerpt: string;
  published_at: string;
}

interface PrestasiComplete {
  settings: PrestasiSettings;
  right_image: PrestasiPost | null;
  list_prestasi: PrestasiPost[];
  list_tahfidz: PrestasiPost[];
}
```

### **React Hook (Custom Hook)**
```typescript
// hooks/usePrestasi.ts
import { useState, useEffect } from 'react';

export const usePrestasi = () => {
  const [data, setData] = useState<PrestasiComplete | null>(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const fetchData = async () => {
      try {
        setLoading(true);
        const response = await fetch(`${process.env.NEXT_PUBLIC_API_BASE}/prestasi`);
        
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const result = await response.json();
        setData(result);
      } catch (err) {
        setError(err instanceof Error ? err.message : 'Unknown error');
      } finally {
        setLoading(false);
      }
    };

    fetchData();
  }, []);

  return { data, loading, error };
};
```

### **Component Implementation**
```typescript
// pages/prestasi.tsx
import { usePrestasi } from '@/hooks/usePrestasi';

export default function PrestasiPage() {
  const { data, loading, error } = usePrestasi();

  if (loading) return <div className="loading">Loading...</div>;
  if (error) return <div className="error">Error: {error}</div>;
  if (!data) return <div className="no-data">No data available</div>;

  const { settings, right_image, list_prestasi, list_tahfidz } = data;

  return (
    <div className="prestasi-page">
      {/* Hero Section */}
      <div 
        className="hero-section"
        style={{ 
          backgroundColor: settings.hero_background_color,
          color: settings.hero_text_color 
        }}
      >
        <h1>{settings.main_heading}</h1>
        
        <p className="hero-subtitle">
          {settings.hero_subtitle}
        </p>
        
        {/* Feature Lists - Two Columns */}
        <div className="grid grid-cols-2 gap-4">
          {settings.feature_lists.slice(0, 4).map((feature, index) => (
            <div key={index} className="flex items-center gap-3">
              <div className="flex-shrink-0 w-5 h-5 bg-green-500 rounded-sm flex items-center justify-center">
                <svg className="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                  <path fillRule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clipRule="evenodd" />
                </svg>
              </div>
              <span className="text-gray-700 font-medium">{feature}</span>
            </div>
          ))}
        </div>
        
        {/* Floating Elements */}
        <div 
          className="floating-elements"
          style={{
            backgroundColor: settings.floating_elements_bg_color,
            color: settings.floating_elements_text_color
          }}
        >
          {/* Floating content */}
        </div>
      </div>

      {/* Right Image Section */}
      {right_image && (
        <div className="right-image-section">
          <img 
            src={right_image.featured_image} 
            alt={right_image.title}
            className="featured-image"
          />
          <div className="content">
            <h3>{right_image.title}</h3>
            <p>{right_image.excerpt}</p>
          </div>
        </div>
      )}

      {/* Prestasi List Section */}
      <div className="prestasi-list-section">
        <h2>Daftar Prestasi</h2>
        <div className="prestasi-grid">
          {list_prestasi.map((prestasi) => (
            <div key={prestasi.id} className="prestasi-card">
              <img 
                src={prestasi.featured_image} 
                alt={prestasi.title}
                className="prestasi-image"
              />
              <div className="prestasi-content">
                <h3>{prestasi.title}</h3>
                <p>{prestasi.excerpt}</p>
                <span className="date">
                  {new Date(prestasi.published_at).toLocaleDateString('id-ID')}
                </span>
              </div>
            </div>
          ))}
        </div>
      </div>

      {/* Tahfidz Section */}
      <div className="tahfidz-section">
        <h2>Prestasi Ujian Tahfidz Sekali Duduk</h2>
        <div className="tahfidz-grid">
          {list_tahfidz.map((tahfidz) => (
            <div key={tahfidz.id} className="tahfidz-card">
              <img 
                src={tahfidz.featured_image} 
                alt={tahfidz.title}
                className="tahfidz-image"
              />
              <div className="tahfidz-content">
                <h3>{tahfidz.title}</h3>
                <p>{tahfidz.excerpt}</p>
                <span className="date">
                  {new Date(tahfidz.published_at).toLocaleDateString('id-ID')}
                </span>
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

## 🎨 **CSS STYLING CONTOH**

### **Hero Section**
```css
.hero-section {
  min-height: 60vh;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
  padding: 2rem;
  position: relative;
  overflow: hidden;
}

.hero-section h1 {
  font-size: 3rem;
  font-weight: bold;
  margin-bottom: 1rem;
  z-index: 10;
}

.floating-elements {
  position: absolute;
  top: 20px;
  right: 20px;
  padding: 1rem;
  border-radius: 8px;
  font-weight: 500;
  z-index: 5;
}
```

### **Responsive Design**
```css
@media (max-width: 768px) {
  .hero-section h1 {
    font-size: 2rem;
  }
  
  .floating-elements {
    top: 10px;
    right: 10px;
    padding: 0.5rem;
    font-size: 0.875rem;
  }
}
```

---

## �� **DATA FLOW**

### **1. Initial Load**
```
Frontend → API /prestasi → Backend → Database → Response
```

### **2. Data Structure**
```
PrestasiSettings (Pengaturan)
├── main_heading
├── hero_background_color
├── hero_text_color
├── floating_elements_bg_color
└── floating_elements_text_color

PrestasiPost (Berita)
├── id
├── title
├── featured_image
├── excerpt
└── published_at

PrestasiComplete (Response Lengkap)
├── settings
├── right_image
├── list_prestasi
└── list_tahfidz
```

---

## 🚀 **PERFORMANCE OPTIMIZATION**

### **1. Image Optimization**
```typescript
// Gunakan Next.js Image component
import Image from 'next/image';

<Image
  src={prestasi.featured_image}
  alt={prestasi.title}
  width={400}
  height={300}
  placeholder="blur"
  blurDataURL="data:image/jpeg;base64,..."
/>
```

### **2. Lazy Loading**
```typescript
// Lazy load untuk list yang panjang
import { useInView } from 'react-intersection-observer';

const { ref, inView } = useInView({
  threshold: 0.1,
  triggerOnce: true
});

{list_prestasi.map((prestasi, index) => (
  <div 
    key={prestasi.id} 
    ref={index === list_prestasi.length - 1 ? ref : null}
    className={inView ? 'fade-in' : 'hidden'}
  >
    {/* Content */}
  </div>
))}
```

---

## 🧪 **TESTING & DEBUGGING**

### **1. Test API Endpoints**
```bash
# Test settings
<<<<<<< HEAD
curl "https://api.alkapro.id/api/v1/prestasi/settings"

# Test complete data
curl "https://api.alkapro.id/api/v1/prestasi"

# Test individual sections
curl "https://api.alkapro.id/api/v1/prestasi/right-image"
curl "https://api.alkapro.id/api/v1/prestasi/list-prestasi"
curl "https://api.alkapro.id/api/v1/prestasi/list-tahfidz"
=======
curl "https://api.raphnesia.my.id/api/v1/prestasi/settings"

# Test complete data
curl "https://api.raphnesia.my.id/api/v1/prestasi"

# Test individual sections
curl "https://api.raphnesia.my.id/api/v1/prestasi/right-image"
curl "https://api.raphnesia.my.id/api/v1/prestasi/list-prestasi"
curl "https://api.raphnesia.my.id/api/v1/prestasi/list-tahfidz"
>>>>>>> 01cf9e1bd0b1c9f8e46d93c6fdb38a4008df2eeb
```

### **2. Error Handling**
```typescript
// Handle different error types
const handleError = (error: any) => {
  if (error.status === 404) {
    return 'Data prestasi tidak ditemukan';
  }
  if (error.status === 500) {
    return 'Server error, coba lagi nanti';
  }
  if (error.message.includes('fetch')) {
    return 'Koneksi internet bermasalah';
  }
  return 'Terjadi kesalahan tidak diketahui';
};
```

---

## 📋 **CHECKLIST IMPLEMENTASI**

### **Frontend Setup**
- [ ] Install dependencies (fetch/axios)
- [ ] Setup environment variables
- [ ] Create custom hooks
- [ ] Setup error handling
- [ ] Setup loading states

### **Components**
- [ ] Hero Section dengan floating elements
- [ ] Right Image Section
- [ ] Prestasi List Section
- [ ] Tahfidz Section
- [ ] Responsive design

### **Features**
- [ ] Dynamic colors dari API
- [ ] Dynamic main heading
- [ ] Image loading dengan fallback
- [ ] Date formatting
- [ ] Error boundaries

---

## 🔗 **LINKS & REFERENCES**

<<<<<<< HEAD
- **API Base**: `https://api.alkapro.id/api/v1`
- **Admin Panel**: `https://api.alkapro.id/admin`
- **Git Repository**: `alkaproia/backendapischool`
=======
- **API Base**: `https://api.raphnesia.my.id/api/v1`
- **Admin Panel**: `https://api.raphnesia.my.id/admin`
- **Git Repository**: `Raphnesia/backendapischool`
>>>>>>> 01cf9e1bd0b1c9f8e46d93c6fdb38a4008df2eeb
- **Main Docs**: `FRONTEND_API_DOCS.md`

---

## 📞 **SUPPORT**

Jika ada masalah:
1. Cek API response dengan curl
2. Cek browser console untuk error
3. Cek network tab untuk request/response
4. Cek error log di hosting
5. Hubungi backend developer

---

**🎉 Prestasi API sudah siap dan lengkap! Semua field baru sudah tersedia untuk frontend integration.** 
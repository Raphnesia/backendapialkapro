# Frontend API Documentation

## Base URL
```
<<<<<<< HEAD
https://api.alkapro.id/api/v1
=======
https://api.raphnesia.my.id/api/v1
>>>>>>> 01cf9e1bd0b1c9f8e46d93c6fdb38a4008df2eeb
```

## Authentication
Semua endpoint menggunakan public access (tidak memerlukan authentication).

---

## 1. Tapak Suci

### Endpoints

#### GET `/tapak-suci`
Mengambil semua data Tapak Suci (pengurus, settings, content)

**Response:**
```json
{
  "settings": {
    "title": "Tapak Suci",
    "subtitle": "Pencak Silat Muhammadiyah",
<<<<<<< HEAD
    "banner_desktop": "https://api.alkapro.id/storage/...",
    "banner_mobile": "https://api.alkapro.id/storage/...",
=======
    "banner_desktop": "https://api.raphnesia.my.id/storage/...",
    "banner_mobile": "https://api.raphnesia.my.id/storage/...",
>>>>>>> 01cf9e1bd0b1c9f8e46d93c6fdb38a4008df2eeb
    "title_panel_bg_color": "#1e40af",
    "subtitle_panel_bg_color": "#3b82f6",
    "mobile_panel_bg_color": "#1e40af"
  },
  "pengurus": [
    {
      "id": 1,
      "position": "Ketua",
      "name": "Nama Ketua",
<<<<<<< HEAD
      "photo": "https://api.alkapro.id/storage/...",
=======
      "photo": "https://api.raphnesia.my.id/storage/...",
>>>>>>> 01cf9e1bd0b1c9f8e46d93c6fdb38a4008df2eeb
      "kelas": "IX A",
      "description": "Deskripsi ketua",
      "order_index": 1,
      "is_active": true
    }
  ],
  "content": [
    {
      "id": 1,
      "title": "Sejarah Tapak Suci",
      "content": "Konten sejarah...",
      "grid_type": "single",
      "use_list_disc": true,
      "list_items": ["Item 1", "Item 2"],
      "bidang_structure": {
        "bidang": "Bidang A",
        "sub_bidang": ["Sub A1", "Sub A2"]
      },
      "background_color": "#f3f4f6",
      "border_color": "#d1d5db",
      "order_index": 1,
      "is_active": true
    }
  ]
}
```

#### GET `/tapak-suci/settings`
Mengambil pengaturan Tapak Suci saja

#### GET `/tapak-suci/pengurus`
Mengambil data pengurus Tapak Suci saja

#### GET `/tapak-suci/content`
Mengambil konten Tapak Suci saja

---

## 2. Hisbul Wathan

### Endpoints

#### GET `/hisbul-wathan`
Mengambil semua data Hisbul Wathan (pengurus, settings, content)

**Response:**
```json
{
  "settings": {
    "title": "Hisbul Wathan",
    "subtitle": "Kepanduan Muhammadiyah",
<<<<<<< HEAD
    "banner_desktop": "https://api.alkapro.id/storage/...",
    "banner_mobile": "https://api.alkapro.id/storage/...",
=======
    "banner_desktop": "https://api.raphnesia.my.id/storage/...",
    "banner_mobile": "https://api.raphnesia.my.id/storage/...",
>>>>>>> 01cf9e1bd0b1c9f8e46d93c6fdb38a4008df2eeb
    "title_panel_bg_color": "#059669",
    "subtitle_panel_bg_color": "#10b981",
    "mobile_panel_bg_color": "#059669"
  },
  "pengurus": [
    {
      "id": 1,
      "position": "Ketua",
      "name": "Nama Ketua",
<<<<<<< HEAD
      "photo": "https://api.alkapro.id/storage/...",
=======
      "photo": "https://api.raphnesia.my.id/storage/...",
>>>>>>> 01cf9e1bd0b1c9f8e46d93c6fdb38a4008df2eeb
      "kelas": "IX A",
      "description": "Deskripsi ketua",
      "order_index": 1,
      "is_active": true
    }
  ],
  "content": [
    {
      "id": 1,
      "title": "Sejarah Hisbul Wathan",
      "content": "Konten sejarah...",
      "grid_type": "single",
      "use_list_disc": true,
      "list_items": ["Item 1", "Item 2"],
      "bidang_structure": {
        "bidang": "Bidang A",
        "sub_bidang": ["Sub A1", "Sub A2"]
      },
      "background_color": "#f3f4f6",
      "border_color": "#d1d5db",
      "order_index": 1,
      "is_active": true
    }
  ]
}
```

#### GET `/hisbul-wathan/settings`
Mengambil pengaturan Hisbul Wathan saja

#### GET `/hisbul-wathan/pengurus`
Mengambil data pengurus Hisbul Wathan saja

#### GET `/hisbul-wathan/content`
Mengambil konten Hisbul Wathan saja

---

## 3. Prestasi

### Endpoints

#### GET `/prestasi`
Mengambil semua data Prestasi (settings, right image, list prestasi, list tahfidz)

**Response:**
```json
{
  "settings": {
    "main_heading": "Prestasi Sekolah",
    "hero_bg_from": "#1e40af",
    "hero_bg_via": "#3b82f6", 
    "hero_bg_to": "#60a5fa",
    "badge_text": "Prestasi Terbaru",
    "floating_elements_bg_color": "#fbbf24",
    "floating_elements_text_color": "#ffffff"
  },
  "right_image": {
    "id": 1,
    "title": "Judul Berita Prestasi",
<<<<<<< HEAD
    "featured_image": "https://api.alkapro.id/storage/...",
=======
    "featured_image": "https://api.raphnesia.my.id/storage/...",
>>>>>>> 01cf9e1bd0b1c9f8e46d93c6fdb38a4008df2eeb
    "excerpt": "Ringkasan berita prestasi...",
    "published_at": "2024-12-19T10:00:00.000000Z"
  },
  "list_prestasi": [
    {
      "id": 1,
      "title": "Juara 1 Lomba Matematika",
<<<<<<< HEAD
      "featured_image": "https://api.alkapro.id/storage/...",
=======
      "featured_image": "https://api.raphnesia.my.id/storage/...",
>>>>>>> 01cf9e1bd0b1c9f8e46d93c6fdb38a4008df2eeb
      "excerpt": "Siswa berhasil meraih...",
      "published_at": "2024-12-19T10:00:00.000000Z"
    }
  ],
  "list_tahfidz": [
    {
      "id": 2,
      "title": "Ujian Tahfidz Sekali Duduk",
<<<<<<< HEAD
      "featured_image": "https://api.alkapro.id/storage/...",
=======
      "featured_image": "https://api.raphnesia.my.id/storage/...",
>>>>>>> 01cf9e1bd0b1c9f8e46d93c6fdb38a4008df2eeb
      "excerpt": "Siswa berhasil menghafal...",
      "published_at": "2024-12-19T10:00:00.000000Z"
    }
  ]
}
```

#### GET `/prestasi/settings`
Mengambil pengaturan Prestasi saja

#### GET `/prestasi/right-image`
Mengambil gambar kanan dari berita dengan tag "prestasi"

#### GET `/prestasi/list-prestasi`
Mengambil list berita dengan tag "prestasi"

#### GET `/prestasi/list-tahfidz`
Mengambil list berita dengan tag "ujian tahfidz"

---

## 4. Berita/Post

### Endpoints

#### GET `/posts`
Mengambil semua berita yang dipublish

**Query Parameters:**
- `category` (optional): academic, achievement, activity, announcement, history
- `tags` (optional): prestasi, ujian tahfidz, akademik, olahraga, seni
- `page` (optional): halaman untuk pagination

**Response:**
```json
{
  "data": [
    {
      "id": 1,
      "title": "Judul Berita",
      "excerpt": "Ringkasan berita...",
      "content": "Konten lengkap berita...",
<<<<<<< HEAD
      "featured_image": "https://api.alkapro.id/storage/...",
=======
      "featured_image": "https://api.raphnesia.my.id/storage/...",
>>>>>>> 01cf9e1bd0b1c9f8e46d93c6fdb38a4008df2eeb
      "category": "achievement",
      "tags": ["prestasi", "akademik"],
      "is_published": true,
      "published_at": "2024-12-19T10:00:00.000000Z",
      "created_at": "2024-12-19T10:00:00.000000Z",
      "updated_at": "2024-12-19T10:00:00.000000Z"
    }
  ],
  "links": {...},
  "meta": {...}
}
```

---

## TypeScript Types

```typescript
// Tapak Suci Types
interface TapakSuciSettings {
  title: string;
  subtitle: string;
  banner_desktop: string;
  banner_mobile: string;
  title_panel_bg_color: string;
  subtitle_panel_bg_color: string;
  mobile_panel_bg_color: string;
}

interface TapakSuciPengurus {
  id: number;
  position: string;
  name: string;
  photo: string;
  kelas: string;
  description: string;
  order_index: number;
  is_active: boolean;
}

interface TapakSuciContent {
  id: number;
  title: string;
  content: string;
  grid_type: 'single' | 'double' | 'triple';
  use_list_disc: boolean;
  list_items: string[];
  bidang_structure: {
    bidang: string;
    sub_bidang: string[];
  };
  background_color: string;
  border_color: string;
  order_index: number;
  is_active: boolean;
}

// Hisbul Wathan Types
interface HisbulWathanSettings {
  title: string;
  subtitle: string;
  banner_desktop: string;
  banner_mobile: string;
  title_panel_bg_color: string;
  subtitle_panel_bg_color: string;
  mobile_panel_bg_color: string;
}

interface HisbulWathanPengurus {
  id: number;
  position: string;
  name: string;
  photo: string;
  kelas: string;
  description: string;
  order_index: number;
  is_active: boolean;
}

interface HisbulWathanContent {
  id: number;
  title: string;
  content: string;
  grid_type: 'single' | 'double' | 'triple';
  use_list_disc: boolean;
  list_items: string[];
  bidang_structure: {
    bidang: string;
    sub_bidang: string[];
  };
  background_color: string;
  border_color: string;
  order_index: number;
  is_active: boolean;
}

// Prestasi Types
interface PrestasiSettings {
  main_heading: string;
  hero_bg_from: string;
  hero_bg_via: string;
  hero_bg_to: string;
  badge_text: string;
  floating_elements_bg_color: string;
  floating_elements_text_color: string;
}

interface Post {
  id: number;
  title: string;
  excerpt: string;
  content: string;
  featured_image: string;
  category: 'academic' | 'achievement' | 'activity' | 'announcement' | 'history';
  tags: string[];
  is_published: boolean;
  published_at: string;
  created_at: string;
  updated_at: string;
}

// Complete Response Types
interface TapakSuciComplete {
  settings: TapakSuciSettings;
  pengurus: TapakSuciPengurus[];
  content: TapakSuciContent[];
}

interface HisbulWathanComplete {
  settings: HisbulWathanSettings;
  pengurus: HisbulWathanPengurus[];
  content: HisbulWathanContent[];
}

interface PrestasiComplete {
  settings: PrestasiSettings;
  right_image: Post | null;
  list_prestasi: Post[];
  list_tahfidz: Post[];
}
```

---

## Implementation Examples

### React Hook untuk Fetch Data

```typescript
// hooks/useTapakSuci.ts
import { useState, useEffect } from 'react';

export const useTapakSuci = () => {
  const [data, setData] = useState<TapakSuciComplete | null>(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const response = await fetch(`${process.env.NEXT_PUBLIC_API_BASE}/tapak-suci`);
        if (!response.ok) throw new Error('Failed to fetch');
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

// hooks/useHisbulWathan.ts
export const useHisbulWathan = () => {
  const [data, setData] = useState<HisbulWathanComplete | null>(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const response = await fetch(`${process.env.NEXT_PUBLIC_API_BASE}/hisbul-wathan`);
        if (!response.ok) throw new Error('Failed to fetch');
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

// hooks/usePrestasi.ts
export const usePrestasi = () => {
  const [data, setData] = useState<PrestasiComplete | null>(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const response = await fetch(`${process.env.NEXT_PUBLIC_API_BASE}/prestasi`);
        if (!response.ok) throw new Error('Failed to fetch');
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

### Penggunaan di Component

```typescript
// pages/profil/tapak-suci.tsx
import { useTapakSuci } from '@/hooks/useTapakSuci';

export default function TapakSuciPage() {
  const { data, loading, error } = useTapakSuci();

  if (loading) return <div>Loading...</div>;
  if (error) return <div>Error: {error}</div>;
  if (!data) return <div>No data</div>;

  return (
    <div>
      <div 
        style={{ 
          backgroundImage: `url(${data.settings.banner_desktop})`,
          backgroundColor: data.settings.title_panel_bg_color 
        }}
      >
        <h1>{data.settings.title}</h1>
        <p>{data.settings.subtitle}</p>
      </div>
      
      {/* Pengurus */}
      <div>
        {data.pengurus.map((pengurus) => (
          <div key={pengurus.id}>
            <img src={pengurus.photo} alt={pengurus.name} />
            <h3>{pengurus.position}</h3>
            <p>{pengurus.name}</p>
            <p>{pengurus.kelas}</p>
            <p>{pengurus.description}</p>
          </div>
        ))}
      </div>

      {/* Content */}
      <div>
        {data.content.map((item) => (
          <div 
            key={item.id}
            style={{
              backgroundColor: item.background_color,
              borderColor: item.border_color
            }}
          >
            <h3>{item.title}</h3>
            <div>{item.content}</div>
            {item.use_list_disc && (
              <ul>
                {item.list_items.map((listItem, index) => (
                  <li key={index}>{listItem}</li>
                ))}
              </ul>
            )}
            {item.bidang_structure && (
              <div>
                <h4>{item.bidang_structure.bidang}</h4>
                <ul>
                  {item.bidang_structure.sub_bidang.map((sub, index) => (
                    <li key={index}>{sub}</li>
                  ))}
                </ul>
              </div>
            )}
          </div>
        ))}
      </div>
    </div>
  );
}
```

---

## Environment Variables

```bash
# .env.local
<<<<<<< HEAD
NEXT_PUBLIC_API_BASE=https://api.alkapro.id/api/v1
=======
NEXT_PUBLIC_API_BASE=https://api.raphnesia.my.id/api/v1
>>>>>>> 01cf9e1bd0b1c9f8e46d93c6fdb38a4008df2eeb
```

---

## Error Handling

Semua endpoint mengembalikan response dengan format:

**Success (200):**
```json
{
  "data": {...} // atau langsung object untuk endpoint tertentu
}
```

**Error (4xx/5xx):**
```json
{
  "message": "Error description",
  "errors": {...} // untuk validation errors
}
```

---

## Notes

<<<<<<< HEAD
1. **Image URLs**: Semua gambar menggunakan base URL `https://api.alkapro.id/storage/`
=======
1. **Image URLs**: Semua gambar menggunakan base URL `https://api.raphnesia.my.id/storage/`
>>>>>>> 01cf9e1bd0b1c9f8e46d93c6fdb38a4008df2eeb
2. **Colors**: Semua warna dalam format HEX (#RRGGBB)
3. **Dates**: Format ISO 8601 (YYYY-MM-DDTHH:mm:ss.ssssssZ)
4. **Pagination**: Hanya untuk endpoint `/posts` dengan parameter `page`
5. **Tags**: Berita bisa memiliki multiple tags, termasuk "prestasi" dan "ujian tahfidz"
6. **Categories**: Berita dikategorikan sebagai academic, achievement, activity, announcement, atau history 
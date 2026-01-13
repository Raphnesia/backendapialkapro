# Program Khusus API v1 – Dokumentasi untuk Frontend

Dokumentasi ini menjelaskan cara konsumsi API Program Khusus dari frontend (Next.js). Semua data diatur dari dashboard (Filament), frontend cukup menampilkan konten berdasarkan struktur JSON di bawah.

## Ringkas
- Base URL: `/api/v1`
- Endpoints:
  - GET `/program-khusus` → data halaman utama + semua tipe (keyed by slug)
  - GET `/program-khusus/{slug}` → data detail per tipe (slug: `ict`, `tahfidz`)
  - GET `/program-khusus-types` → list semua tipe (termasuk inactive)
  - POST `/program-khusus/page` → create halaman utama
  - PUT `/program-khusus/page/{id}` → update halaman utama
  - DELETE `/program-khusus/page/{id}` → hapus halaman utama
  - POST `/program-khusus/type` → create tipe baru (slug, banner, blocks)
  - PUT `/program-khusus/type/{slug}` → update tipe berdasarkan slug
  - DELETE `/program-khusus/type/{slug}` → hapus tipe berdasarkan slug
- Auth: tidak diperlukan
- Format response: `{ success: boolean, data: any }`

---

## GET /program-khusus
Mengambil data untuk halaman list `/program-khusus`: hero + overview + cards program + alasan (reasons) + CTA, serta data ringkas semua tipe (`ict`, `tahfidz`).

Contoh response:
```json
{
  "success": true,
  "data": {
    "page": {
      "id": 1,
      "hero_title": "Program Khusus",
      "hero_subtitle": "Program unggulan SMP Muhammadiyah Al Kautsar PK Kartasura yang dirancang untuk mengembangkan potensi siswa secara optimal",
      "hero_image_desktop": "/storage/program-khusus/hero-desktop.jpg",
      "hero_image_mobile": "/storage/program-khusus/hero-mobile.jpg",
      "overview_title": "Program Unggulan Kami",
      "overview_subtitle": "Kami menawarkan dua program khusus yang dirancang untuk mengembangkan potensi akademik dan spiritual siswa",
      "programs": [
        {
          "id": "tahfidz",
          "title": "Program Tahfidz Al-Quran",
          "subtitle": "Membentuk generasi Qurani melalui hafalan Al-Quran dengan metode pembelajaran yang menyenangkan dan efektif.",
          "description": "Program Tahfidz Al-Quran di sekolah kami menggunakan metode pembelajaran yang telah terbukti efektif dalam membantu siswa menghafal Al-Quran dengan mudah dan menyenangkan.",
          "image": "/storage/program-khusus/tahfidz-program.jpg",
          "color": "green",
          "href": "/program-khusus/tahfidz",
          "features": [
            "Metode pembelajaran terbukti efektif",
            "Ustadz dan ustadzah berpengalaman",
            "Fasilitas ruang tahfidz yang nyaman",
            "Lingkungan Islami yang mendukung"
          ]
        },
        {
          "id": "ict",
          "title": "Program ICT (Information and Communication Technology)",
          "subtitle": "Mempersiapkan siswa menghadapi era digital dengan pembelajaran teknologi informasi dan komunikasi yang komprehensif.",
          "description": "Program ICT dirancang untuk memberikan pemahaman mendalam tentang teknologi informasi dan komunikasi yang relevan dengan perkembangan zaman.",
          "image": "/storage/program-khusus/ict-program.jpg",
          "color": "blue",
          "href": "/program-khusus/ict",
          "features": [
            "Kurikulum ICT terkini",
            "Laboratorium komputer modern",
            "Pembelajaran praktis dan project-based",
            "Sertifikasi internasional"
          ]
        }
      ],
      "reasons_title": "Mengapa Memilih Program Khusus Kami?",
      "reasons_subtitle": "Program khusus kami dirancang dengan pendekatan holistik untuk mengembangkan potensi siswa secara optimal, menggabungkan keahlian akademik dengan pembentukan karakter",
      "reasons": [
        {
          "icon": "🎯",
          "title": "Fokus Spesifik",
          "description": "Setiap program dirancang dengan kurikulum yang fokus dan mendalam sesuai dengan bidang yang dipilih, memastikan penguasaan kompetensi secara komprehensif"
        },
        {
          "icon": "👨‍🏫",
          "title": "Pengajar Ahli",
          "description": "Dibimbing oleh pengajar yang berpengalaman dan ahli di bidangnya masing-masing, dengan sertifikasi profesional dan pengalaman praktik yang luas"
        },
        {
          "icon": "🏆",
          "title": "Prestasi Terbukti",
          "description": "Program kami telah menghasilkan siswa-siswa berprestasi di berbagai kompetisi nasional dan internasional, dengan track record yang konsisten"
        }
      ],
      "cta_title": "Siap Bergabung dengan Program Khusus Kami?",
      "cta_subtitle": "Pilih program yang sesuai dengan minat dan bakat Anda untuk mengembangkan potensi secara optimal",
      "cta_primary_label": "Program Tahfidz",
      "cta_primary_url": "/program-khusus/tahfidz",
      "cta_secondary_label": "Program ICT",
      "cta_secondary_url": "/program-khusus/ict",
          "is_active": true,
      "created_at": "2025-08-09T02:00:00.000000Z",
      "updated_at": "2025-08-09T02:00:00.000000Z"
    },
    "types": {
      "ict": {
        "id": 10,
        "slug": "ict",
        "title": "Program ICT",
        "subtitle": "Program unggulan yang memadukan pendidikan akademik dengan teknologi informasi dan komunikasi",
        "banner_desktop": "/storage/program-khusus/ict-banner-desktop.jpg",
        "banner_mobile": "/storage/program-khusus/ict-banner-mobile.jpg",
        "is_active": true,
        "created_at": "...",
        "updated_at": "..."
      },
      "tahfidz": {
        "id": 11,
        "slug": "tahfidz",
        "title": "Program Tahfidz Al-Quran",
        "subtitle": "Program unggulan yang memadukan pendidikan akademik dengan penghafalan Al-Quran",
        "banner_desktop": "/storage/program-khusus/tahfidz-banner-desktop.jpg",
        "banner_mobile": "/storage/program-khusus/tahfidz-banner-mobile.jpg",
        "is_active": true,
        "created_at": "...",
        "updated_at": "..."
      }
    }
  }
}
```

---

## GET /program-khusus/{slug}
Mengambil data detail tipe untuk halaman `/program-khusus/ict` atau `/program-khusus/tahfidz`.

Path params:
- `slug`: `ict` | `tahfidz`

Response (200):
```json
{
  "success": true,
  "data": {
    "id": 10,
    "slug": "ict",
    "title": "Program ICT",
    "subtitle": "Program unggulan yang memadukan pendidikan akademik dengan teknologi informasi dan komunikasi",
    "banner_desktop": "/storage/program-khusus/ict-banner-desktop.jpg",
    "banner_mobile": "/storage/program-khusus/ict-banner-mobile.jpg",
    
    "intro_badge": "Pendidikan Digital",
    "intro_title": "Menggabungkan Akademik & Digital",
    "intro_subtitle": "Program ICT di SMP Muhammadiyah Al Kautsar PK Kartasura dirancang khusus untuk siswa yang ingin menguasai teknologi informasi dan komunikasi sambil tetap mengikuti kurikulum akademik nasional dengan metode pembelajaran yang telah terbukti efektif.",
    
      "featured_image": "/storage/program-khusus/ict-featured.jpg",
    "featured_overlay_title": "Suasana Pembelajaran",
    "featured_overlay_desc": "Lingkungan yang kondusif untuk belajar teknologi dengan fasilitas modern",
    "featured_badge": "Program Unggulan",
    
      "key_points": [
      {
        "icon": "🖥️",
        "title": "Teknologi Terkini",
        "description": "Menggunakan perangkat dan software terbaru untuk pembelajaran ICT yang optimal, termasuk hardware kelas enterprise dan software development tools modern."
      },
      {
        "icon": "👥",
        "title": "Instruktur Ahli",
        "description": "Dibimbing oleh instruktur berpengalaman di bidang teknologi informasi dan programming dengan sertifikasi profesional dan pengalaman industri yang luas."
      }
    ],
    
    "features_title": "Mengapa Memilih Program Kami",
    "features_subtitle": "Alasan kuat untuk memilih program ICT kami yang telah terbukti menghasilkan lulusan berkualitas",
    "features_image": "/storage/program-khusus/ict-features.jpg",
    "features_items": [
      {
        "icon": "📚",
        "title": "Metode Pembelajaran",
        "description": "Menggunakan metode project-based learning dan hands-on training yang terbukti efektif dalam menguasai ICT"
      },
      {
        "icon": "👥",
        "title": "Bimbingan Personal",
        "description": "Setiap siswa dibimbing secara individual oleh instruktur berpengalaman di bidang teknologi"
      },
      {
        "icon": "🎯",
        "title": "Target Skill",
        "description": "Target disesuaikan kemampuan: programming, design grafis, dan digital marketing sesuai minat siswa"
      },
      {
        "icon": "🏆",
        "title": "Evaluasi Berkala",
        "description": "Sistem monitoring dan evaluasi terstruktur untuk memastikan progress optimal dalam penguasaan skill digital"
      }
    ],
    
    "benefits_badge": "Tiga Kompetensi Utama",
    "benefits_title": "Dampak Positif Program ICT",
    "benefits_subtitle": "Program ICT memberikan dampak positif komprehensif melalui tiga kompetensi utama",
    "benefits_items": [
      {
        "badge_label": "Kompetensi 1",
        "title": "Programming & Development",
        "description": "Pembelajaran programming yang komprehensif meliputi Web Development (HTML, CSS, JavaScript), Mobile Development, dan Database Management untuk membentuk developer handal yang siap bersaing di era digital.",
        "image": "/storage/program-khusus/ict-benefit-1.jpg",
        "layout": "imageLeft"
      },
      {
        "badge_label": "Kompetensi 2",
        "title": "Digital Design",
        "description": "Kurikulum design grafis yang terukur dan sistematis untuk membentuk kreativitas digital, mencakup UI/UX design, graphic design, dan multimedia production.",
        "image": "/storage/program-khusus/ict-benefit-2.jpg",
        "layout": "imageRight"
      },
      {
        "badge_label": "Kompetensi 3",
        "title": "Digital Marketing",
        "description": "Pengenalan digital marketing secara intensif yang mencakup social media marketing, SEO optimization, dan content creation untuk membekali siswa dengan skill marketing digital.",
        "image": "/storage/program-khusus/ict-benefit-3.jpg",
        "layout": "imageLeft"
      }
    ],
    
    "gallery_title": "Galeri Pembelajaran",
    "gallery_subtitle": "Suasana pembelajaran yang kondusif dan inspiratif dengan fasilitas modern",
    "gallery_items": [
      {
        "src": "/storage/program-khusus/ict-gallery-1.jpg",
        "title": "Lab Programming",
        "desc": "Laboratorium komputer dengan perangkat modern",
        "color_gradient": "from-blue-500 to-cyan-500"
      },
      {
        "src": "/storage/program-khusus/ict-gallery-2.jpg",
        "title": "Design Studio",
        "desc": "Studio design dengan software terkini",
        "color_gradient": "from-purple-500 to-indigo-500"
      },
      {
        "src": "/storage/program-khusus/ict-gallery-3.jpg",
        "title": "Digital Workshop",
        "desc": "Workshop digital dengan proyek nyata",
        "color_gradient": "from-cyan-500 to-teal-500"
      }
    ],
    
    "cta_background": "/storage/program-khusus/ict-cta-bg.jpg",
    "cta_badge": "Bergabung Sekarang",
    "cta_title": "Siap Menjadi Bagian dari Generasi Digital?",
    "cta_description": "Bergabunglah dengan Program ICT SMP Muhammadiyah Al Kautsar PK Kartasura dan jadilah bagian dari generasi digital yang unggul dalam skill teknologi dan berprestasi akademik. Program ini tidak hanya membentuk developer handal, tetapi juga pribadi yang kreatif dan inovatif.",
    "cta_primary_label": "Lihat Program Lainnya",
    "cta_primary_url": "/program-khusus",
    "cta_secondary_label": "Tentang Sekolah",
    "cta_secondary_url": "/profil",
    
    "is_active": true,
    "created_at": "...",
    "updated_at": "..."
  }
}
```

Response (404):
```json
{ "success": false, "message": "Not found" }
```

---

## Admin API (CRUD)

Semua endpoint berikut non-auth (disarankan tambah middleware auth di production).

### GET /program-khusus-types
List seluruh tipe (termasuk yang `is_active = false`).

Response:
```json
{ "success": true, "data": [ { "slug": "ict", "title": "...", "is_active": true }, { "slug": "tahfidz", "title": "...", "is_active": false } ] }
```

### POST /program-khusus/page
Body:
```json
{
  "hero_title": "Program Khusus",
  "hero_subtitle": "Program unggulan SMP Muhammadiyah...",
  "hero_image_desktop": "/storage/program-khusus/hero-desktop.jpg",
  "hero_image_mobile": "/storage/program-khusus/hero-mobile.jpg",
  "overview_title": "Program Unggulan Kami",
  "overview_subtitle": "Kami menawarkan dua program khusus...",
  "programs": [],
  "reasons_title": "Mengapa Memilih Program Khusus Kami?",
  "reasons_subtitle": "Program khusus kami dirancang dengan pendekatan holistik...",
  "reasons": [],
  "cta_title": "Siap Bergabung dengan Program Khusus Kami?",
  "cta_subtitle": "Pilih program yang sesuai dengan minat dan bakat Anda...",
  "cta_primary_label": "Program Tahfidz",
  "cta_primary_url": "/program-khusus/tahfidz",
  "cta_secondary_label": "Program ICT",
  "cta_secondary_url": "/program-khusus/ict",
  "is_active": true
}
```
Response 201: `{ "success": true, "data": { ... } }`

### PUT /program-khusus/page/{id}
Body sama seperti POST (semua field optional; hanya yang dikirim yang diupdate).

### DELETE /program-khusus/page/{id}
Response: `{ "success": true }`

### POST /program-khusus/type
Body:
```json
{
  "slug": "ict",
  "title": "Program ICT",
  "subtitle": "Program unggulan yang memadukan pendidikan akademik dengan teknologi informasi dan komunikasi",
  "banner_desktop": "/storage/program-khusus/ict-banner-desktop.jpg",
  "banner_mobile": "/storage/program-khusus/ict-banner-mobile.jpg",
  "intro_badge": "Pendidikan Digital",
  "intro_title": "Menggabungkan Akademik & Digital",
  "intro_subtitle": "Program ICT di SMP Muhammadiyah Al Kautsar PK Kartasura...",
  "featured_image": "/storage/program-khusus/ict-featured.jpg",
  "featured_overlay_title": "Suasana Pembelajaran",
  "featured_overlay_desc": "Lingkungan yang kondusif untuk belajar teknologi...",
  "featured_badge": "Program Unggulan",
  "key_points": [],
  "features_title": "Mengapa Memilih Program Kami",
  "features_subtitle": "Alasan kuat untuk memilih program ICT kami...",
  "features_image": "/storage/program-khusus/ict-features.jpg",
  "features_items": [],
  "benefits_badge": "Tiga Kompetensi Utama",
  "benefits_title": "Dampak Positif Program ICT",
  "benefits_subtitle": "Program ICT memberikan dampak positif komprehensif...",
  "benefits_items": [],
  "gallery_title": "Galeri Pembelajaran",
  "gallery_subtitle": "Suasana pembelajaran yang kondusif dan inspiratif...",
  "gallery_items": [],
  "cta_background": "/storage/program-khusus/ict-cta-bg.jpg",
  "cta_badge": "Bergabung Sekarang",
  "cta_title": "Siap Menjadi Bagian dari Generasi Digital?",
  "cta_description": "Bergabunglah dengan Program ICT SMP Muhammadiyah...",
  "cta_primary_label": "Lihat Program Lainnya",
  "cta_primary_url": "/program-khusus",
  "cta_secondary_label": "Tentang Sekolah",
  "cta_secondary_url": "/profil",
  "is_active": true
}
```
Response 201: `{ "success": true, "data": { ... } }`

### PUT /program-khusus/type/{slug}
Body: semua field optional selain slug (di path). Contoh:
```json
{
  "title": "Program ICT Updated",
  "intro_title": "Menggabungkan Akademik & Digital Updated"
}
```
Response: `{ "success": true, "data": { ... } }`

### DELETE /program-khusus/type/{slug}
Response: `{ "success": true }`

---

## Skema Data

### ProgramKhususPage
- `hero_title`: string
- `hero_subtitle`: string
- `hero_image_desktop`: string (path gambar upload)
- `hero_image_mobile`: string (path gambar upload)
- `overview_title`: string
- `overview_subtitle`: string
- `programs`: `ProgramCard[]`
- `reasons_title`: string
- `reasons_subtitle`: string
- `reasons`: `Reason[]`
- `cta_title`: string
- `cta_subtitle`: string
- `cta_primary_label`: string
- `cta_primary_url`: string
- `cta_secondary_label`: string
- `cta_secondary_url`: string
- `is_active`: boolean

### ProgramCard
- `id`: `'ict' | 'tahfidz'`
- `title`: string
- `subtitle?`: string
- `description?`: string
- `image?`: string (path gambar upload)
- `color?`: string (misal: `green`, `blue`)
- `href?`: string (opsional; FE bisa generate `/program-khusus/{id}` jika kosong)
- `features?`: `string[]`

### Reason
- `icon?`: string (emoji disarankan)
- `title`: string
- `description`: string

### ProgramKhususType
- `slug`: `'ict' | 'tahfidz'`
- `title?`: string
- `subtitle?`: string
- `banner_desktop?`: string (path gambar upload)
- `banner_mobile?`: string (path gambar upload)
- `intro_badge?`: string
- `intro_title?`: string
- `intro_subtitle?`: string
- `featured_image?`: string (path gambar upload)
- `featured_overlay_title?`: string
- `featured_overlay_desc?`: string
- `featured_badge?`: string
- `key_points?`: `KeyPoint[]`
- `features_title?`: string
- `features_subtitle?`: string
- `features_image?`: string (path gambar upload)
- `features_items?`: `FeatureItem[]`
- `benefits_badge?`: string
- `benefits_title?`: string
- `benefits_subtitle?`: string
- `benefits_items?`: `BenefitItem[]`
- `gallery_title?`: string
- `gallery_subtitle?`: string
- `gallery_items?`: `GalleryItem[]`
- `cta_background?`: string (path gambar upload)
- `cta_badge?`: string
- `cta_title?`: string
- `cta_description?`: string
- `cta_primary_label?`: string
- `cta_primary_url?`: string
- `cta_secondary_label?`: string
- `cta_secondary_url?`: string
- `is_active`: boolean

### KeyPoint
- `icon?`: string (emoji)
- `title`: string
- `description`: string

### FeatureItem
- `icon?`: string (emoji)
- `title`: string
- `description`: string

### BenefitItem
- `badge_label?`: string
- `title`: string
- `description`: string
- `image?`: string (path gambar upload)
- `layout?`: `'imageLeft' | 'imageRight'`

### GalleryItem
- `src?`: string (path gambar upload)
- `title`: string
- `desc`: string
- `color_gradient?`: string (Tailwind gradient class)

---

## Integrasi Frontend (Next.js)

### Fetch helpers
```ts
// Halaman list /program-khusus
export async function fetchProgramKhusus() {
  const res = await fetch('/api/v1/program-khusus', { cache: 'no-store' });
  if (!res.ok) throw new Error('Failed to fetch');
  return res.json();
}

// Halaman detail /program-khusus/[slug]
export async function fetchProgramKhususType(slug: 'ict' | 'tahfidz') {
  const res = await fetch(`/api/v1/program-khusus/${slug}`, { cache: 'no-store' });
  if (res.status === 404) return null;
  if (!res.ok) throw new Error('Failed to fetch');
  return res.json();
}
```

### Mapping cepat ke UI yang sudah ada
- `/program-khusus`
  - Hero → `page.hero_*`
  - Section "Program Unggulan Kami" → `page.overview_*` + `page.programs`
  - Section "Mengapa Memilih …" → `page.reasons_title`, `page.reasons_subtitle`, `page.reasons`
  - CTA → `page.cta_*`
- `/program-khusus/ict` dan `/program-khusus/tahfidz`
  - Banner/Hero → `type.title`, `type.subtitle`, `type.banner_*`
  - Introduction → `type.intro_*`
  - Featured Image → `type.featured_*`
  - Key Points → `type.key_points`
  - Features Grid → `type.features_*`
  - Benefits → `type.benefits_*`
  - Gallery → `type.gallery_*`
  - CTA → `type.cta_*`

---

## Catatan Implementasi
- **Path gambar upload:** Semua gambar disimpan di `/storage/program-khusus/` dan diakses via `/storage/program-khusus/filename.jpg`
- Gunakan `cache: 'no-store'` untuk memastikan data terbaru.
- Abaikan field opsional yang tidak ada (render fallback/placeholder di FE).
- Slug valid: `ict`, `tahfidz`. Jika 404, FE boleh redirect ke `/program-khusus`.
- Ikon pada JSON bisa berupa emoji. FE boleh memetakan ke ikon `lucide-react` sesuai kebutuhan.
- Warna `color` pada cards bisa dipetakan ke Tailwind class sesuai helper Anda.
- Layout `imageLeft`/`imageRight` untuk benefits section.
- Gradient warna untuk gallery menggunakan Tailwind class (mis: `from-blue-500 to-cyan-500`).
- Versi API diprefix `v1` untuk memudahkan perubahan di masa depan.

---

## TypeScript Interfaces (opsional)
```ts
export type ProgramCard = {
  id: 'ict' | 'tahfidz';
  title: string;
  subtitle?: string;
  description?: string;
  image?: string;
  color?: string;
  href?: string;
  features?: string[];
};

export type KeyPoint = {
  icon?: string;
  title: string;
  description: string;
};

export type FeatureItem = {
  icon?: string;
  title: string;
  description: string;
};

export type BenefitItem = {
  badge_label?: string;
  title: string;
  description: string;
  image?: string;
  layout?: 'imageLeft' | 'imageRight';
};

export type GalleryItem = {
  src?: string;
  title: string;
  desc: string;
  color_gradient?: string;
};

export type ProgramKhususPage = {
  hero_title?: string;
  hero_subtitle?: string;
  hero_image_desktop?: string;
  hero_image_mobile?: string;
  overview_title?: string;
  overview_subtitle?: string;
  programs?: ProgramCard[];
  reasons_title?: string;
  reasons_subtitle?: string;
  reasons?: { icon?: string; title: string; description: string }[];
  cta_title?: string;
  cta_subtitle?: string;
  cta_primary_label?: string;
  cta_primary_url?: string;
  cta_secondary_label?: string;
  cta_secondary_url?: string;
};

export type ProgramKhususType = {
  slug: 'ict' | 'tahfidz';
  title?: string;
  subtitle?: string;
  banner_desktop?: string;
  banner_mobile?: string;
  intro_badge?: string;
  intro_title?: string;
  intro_subtitle?: string;
  featured_image?: string;
  featured_overlay_title?: string;
  featured_overlay_desc?: string;
  featured_badge?: string;
  key_points?: KeyPoint[];
  features_title?: string;
  features_subtitle?: string;
  features_image?: string;
  features_items?: FeatureItem[];
  benefits_badge?: string;
  benefits_title?: string;
  benefits_subtitle?: string;
  benefits_items?: BenefitItem[];
  gallery_title?: string;
  gallery_subtitle?: string;
  gallery_items?: GalleryItem[];
  cta_background?: string;
  cta_badge?: string;
  cta_title?: string;
  cta_description?: string;
  cta_primary_label?: string;
  cta_primary_url?: string;
  cta_secondary_label?: string;
  cta_secondary_url?: string;
};
```

---

## Changelog
- 2025-08-09: Rilis awal API v1 Program Khusus (`/program-khusus`, `/program-khusus/{slug}`)
- 2025-08-09: **UPDATE** - Implementasi upload gambar langsung, struktur data diperbarui untuk mendukung file upload



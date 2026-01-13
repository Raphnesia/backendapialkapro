# Dokumentasi Lengkap Dashboard Beranda (HOME) – Backend API & Integrasi Frontend

Dokumentasi ini menjelaskan cara mengatur semua section Beranda melalui dashboard (Filament) dan cara konsumsi datanya di frontend (Next.js). Seluruh konfigurasi disimpan pada resource `HomeSection` dan diekspos melalui endpoint API yang konsisten.

## Base URL
- Local: `http://localhost:8000/api/v1`
- Env frontend yang direkomendasikan: `NEXT_PUBLIC_API_BASE_URL=http://localhost:8000/api/v1`

## Admin Dashboard (Filament)
- Menu: Home → `Section Home` (model `HomeSection`)
- Tambah/ubah section:
  - Field `section_type` menentukan tipe section (lihat daftar di bawah)
  - `order_index` untuk urutan tampil
  - `is_active` untuk aktif/nonaktif
  - Form “Konfigurasi Khusus Section” otomatis menyesuaikan field sesuai `section_type`
- Khusus Hero Video: Home → `Hero Videos` (opsional, jika ingin memutar video dari entitas khusus)

## Daftar Section dan Konfigurasinya (config_data)
Semua field di bawah tersimpan pada kolom JSON `config_data`. API akan mengubah path file upload menjadi URL lengkap `asset('storage/...')` sehingga siap dipakai frontend.

1) Hero Section (`section_type=hero`)
- `background_mode`: `video` | `image`
- Jika `video`: 
  - `video_source_type`: `upload` | `url`
  - `video_file_desktop`, `video_file_mobile` (upload, MP4)
  - `video_url_desktop`, `video_url_mobile` (URL MP4)
  - `poster_image` (opsional)
- Jika `image`: 
  - `background_image` (upload gambar)
- Konten:
  - `typing_text`, `flip_text`
  - `buttons`: array of { `label`, `url`, `variant`: `primary`|`secondary` }

2) Sambutan Kepala Sekolah (`section_type=principal_welcome`)
- `principal_name`, `principal_position`, `principal_photo`
- `greeting_arabic`, `greeting_message`, `greeting_we_say`, `greeting_welcome`, `greeting_closing`

3) Why Choose Us (`section_type=why_choose_us`)
- `features`: array of { `number`, `title`, `image`, `description` }

4) Fasilitas – Bento Grid (`section_type=facilities`)
- `bento_items`: array of
  - `name`, `description`
  - `media_type`: `video` | `image`
  - Jika video: `video_source`: `upload`|`url`, `video_file` (upload) atau `video_url` (URL MP4)
  - Jika image: `image` (upload)
  - `className` (opsional, mis. `lg:col-span-2`), `cta`

5) Alkapro Smart School Ecosystem (`section_type=alkapro_ecosystem`)
- `apps`: array of { `name`, `description`, `icon` (URL) | `icon_upload` (upload), `url`, `gradient`, `accent` }

6) Prestasi (Islamic Quote) (`section_type=achievements_modern`)
- `islamic_quote_arabic`, `islamic_quote_translation`

7) Testimoni (`section_type=testimonials`)
- `testimonials`: array of { `nama`, `tahun`, `testimoni`, `avatar` }

8) Social Media Feed (`section_type=social_media_feed`)
- `instagram_user_id`, `instagram_access_token`
- `tiktok_user_id`, `tiktok_access_token`
- `instagram_follow_url`, `tiktok_follow_url`

9) YouTube (`section_type=youtube`)
- `channel_id` (wajib), `playlist_id` (opsional)

## Endpoint API

### Home Sections (semua section)
- GET `/home-sections` – semua section aktif, urut
- GET `/home-sections/{id}` – detail by id
- GET `/home-sections/type/{sectionType}` – filter per tipe section
  - Contoh: `/home-sections/type/hero`, `/home-sections/type/principal_welcome`, `/home-sections/type/why_choose_us`, `/home-sections/type/facilities`, `/home-sections/type/alkapro_ecosystem`, `/home-sections/type/achievements_modern`, `/home-sections/type/testimonials`, `/home-sections/type/social_media_feed`, `/home-sections/type/youtube`

Contoh respons (Why Choose Us):
```json
[
  {
    "id": 12,
    "title": "Kenapa Memilih Kami",
    "content": null,
    "image": null,
    "order_index": 3,
    "section_type": "why_choose_us",
    "config_data": {
      "features": [
        {"number": "[01]", "title": "Karakter", "image": "http://localhost:8000/storage/home/why/img1.jpg", "description": "..."},
        {"number": "[02]", "title": "Fasilitas", "image": "http://localhost:8000/storage/home/why/img2.jpg", "description": "..."}
      ]
    }
  }
]
```

### Hero Videos (opsional jika memakai entitas video terpisah)
- GET `/home-hero-videos`
- GET `/home-hero-videos/active`
- GET `/home-hero-videos/{id}`

Skema data (ringkas):
- `source_type`: `upload`|`url`
- `video_desktop`, `video_mobile`, `poster_image`, `is_active`, `order_index`

### Social Media Feed
- GET `/social-media/settings` – kredensial termasker (jangan pakai untuk client langsung)
- GET `/social-media/settings/raw` – kredensial asli (gunakan hanya dari FE server-to-server)
- GET `/social-media/instagram` – proxy Graph API Instagram, mengembalikan daftar post

Contoh respons `/social-media/settings`:
```json
{
  "success": true,
  "data": {
    "instagram_user_id": "1784...",
    "instagram_access_token_masked": "EA...****...1234",
    "tiktok_user_id": null,
    "tiktok_access_token_masked": null,
    "instagram_follow_url": "https://instagram.com/akun",
    "tiktok_follow_url": "https://tiktok.com/@akun",
    "is_configured": true
  }
}
```

Contoh respons `/social-media/instagram` (ringkas):
```json
{
  "success": true,
  "data": [
    {
      "id": "179...",
      "media_type": "VIDEO",
      "media_url": "https://.../video.mp4",
      "thumbnail_url": "https://.../thumb.jpg",
      "caption": "Kegiatan ...",
      "permalink": "https://instagram.com/p/...",
      "timestamp": "2025-08-10T10:00:00+0000"
    }
  ]
}
```

Catatan TikTok: endpoint backend belum dibuat. Frontend dapat memakai route server-side mereka sendiri, mengambil token dari `/social-media/settings/raw`. Jika dibutuhkan, backend bisa ditambahkan endpoint proxy mirip Instagram.

## Integrasi Frontend (Next.js) – Contoh

Setup service:
```ts
const API_BASE = process.env.NEXT_PUBLIC_API_BASE_URL || 'http://localhost:8000/api/v1';

export const homeApi = {
  byType: async (type: string) => {
    const res = await fetch(`${API_BASE}/home-sections/type/${type}`, { cache: 'no-store' });
    const json = await res.json();
    return json.success ? json.data : [];
  },
  heroVideosActive: async () => {
    const res = await fetch(`${API_BASE}/home-hero-videos/active`, { cache: 'no-store' });
    const json = await res.json();
    return json.success ? json.data : [];
  },
  social: {
    settings: async () => {
      const res = await fetch(`${API_BASE}/social-media/settings`, { cache: 'no-store' });
      const json = await res.json();
      return json.success ? json.data : null;
    },
    instagram: async () => {
      const res = await fetch(`${API_BASE}/social-media/instagram`, { cache: 'no-store' });
      const json = await res.json();
      return json.success ? json.data : [];
    }
  }
};
```

Pemakaian di masing-masing section:
- Hero Section: `const [hero] = await homeApi.byType('hero');` gunakan `hero.config_data` untuk `background_mode`, video/gambar, `typing_text`, `flip_text`, `buttons`.
- Sambutan: `const [sambutan] = await homeApi.byType('principal_welcome');` gunakan `principal_*` dan teks salam.
- Why Choose Us: `const [why] = await homeApi.byType('why_choose_us');` gunakan `features`.
- Fasilitas (Bento): `const [fac] = await homeApi.byType('facilities');` gunakan `bento_items`.
- Alkapro Ecosystem: `const [eco] = await homeApi.byType('alkapro_ecosystem');` gunakan `apps`.
- Prestasi (Islamic Quote): `const [ach] = await homeApi.byType('achievements_modern');` gunakan `islamic_quote_*`.
- Testimoni: `const [testi] = await homeApi.byType('testimonials');` gunakan `testimonials`.
- Social Media Feed: 
  - `const social = await homeApi.social.settings()` untuk cek konfigurasi & follow URLs
  - `const igPosts = await homeApi.social.instagram()` untuk feed IG
- YouTube Section: `const [yt] = await homeApi.byType('youtube');` gunakan `channel_id` (dan `playlist_id` bila ada). Frontend bisa mem-fetch RSS channel atau langsung embed sesuai kebutuhan komponen.

## cURL Contoh Cepat
- Why Choose Us:
```bash
curl http://localhost:8000/api/v1/home-sections/type/why_choose_us
```
- Social IG Settings:
```bash
curl http://localhost:8000/api/v1/social-media/settings
```
- Social IG Feed:
```bash
curl http://localhost:8000/api/v1/social-media/instagram
```

## Pertimbangan Keamanan
- Jangan expose `/social-media/settings/raw` ke browser; gunakan hanya dari server-side FE.
- Token IG/TikTok sebaiknya dirotasi bila terdeteksi gagal atau disalahgunakan.

## Catatan Tambahan
- Semua path file upload di `config_data` sudah otomatis menjadi URL penuh oleh API.
- Urutan tampil mengikuti `order_index` di `HomeSection`.
- Jika ingin memakai Hero Videos terpisah, ambil dari `/home-hero-videos/active` dan abaikan pengaturan video di `hero`.

---
Jika ada kebutuhan endpoint tambahan (contoh: proxy TikTok), backend siap ditambahkan menyesuaikan struktur yang sama.



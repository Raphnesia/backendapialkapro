# Dokumentasi API Header & Footer

## Ringkasan
Dokumentasi ini menjelaskan cara mengelola dan mengkonsumsi data Header (Navbar), Marquee, dan Footer melalui dashboard Filament dan API untuk integrasi frontend.

## Endpoint API

### Base URL
```
https://yourdomain.com/api/v1
```

### 1. Header (Navbar) API
**Endpoint:** `GET /navigation/header`

**Deskripsi:** Mengambil data menu header beserta dropdown, logo header, dan teks marquee.

**Response:**
```json
{
  "menu": [
    {
      "id": 1,
      "name": "Profil",
      "href": "/profil",
      "target": "_self",
      "order_index": 1,
      "dropdown": [
        {
          "id": 2,
          "name": "Guru dan Tendik",
          "href": "/profil/guru",
          "target": "_self",
          "order_index": 1
        },
        {
          "id": 3,
          "name": "Sejarah Singkat",
          "href": "/profil/sejarah",
          "target": "_self",
          "order_index": 2
        }
      ]
    },
    {
      "id": 4,
      "name": "Fasilitas",
      "href": "/fasilitas",
      "target": "_self",
      "order_index": 2,
      "dropdown": []
    }
  ],
  "branding": {
    "header_logo": "https://yourdomain.com/storage/branding/logo.png"
  },
  "marquee": [
    {
      "text": "Mendidik dengan Hati, Membentuk Karakter Islami",
      "color": "#ffffff",
      "speed": "normal"
    },
    {
      "text": "Portal Informasi Terdepan untuk Masa Depan Cemerlang",
      "color": "#ffffff",
      "speed": "normal"
    },
    {
      "text": "Selamat datang di SMP Al-Kautsar",
      "color": "#ffffff",
      "speed": "normal"
    }
  ]
}
```

**Field Response:**
- `menu`: Array menu top-level
  - `id`: ID unik menu
  - `name`: Nama menu yang ditampilkan
  - `href`: URL tujuan
  - `target`: Target link (`_self` atau `_blank`)
  - `order_index`: Urutan tampilan
  - `dropdown`: Array sub-menu (kosong jika tidak ada dropdown)
- `branding`: Pengaturan branding header
  - `header_logo`: URL logo header (null jika tidak diatur)
- `marquee`: Array teks marquee yang akan ditampilkan
  - `text`: Teks yang akan di-scroll
  - `color`: Warna teks dalam format hex (#ffffff)
  - `speed`: Kecepatan scroll (slow, normal, fast)

### 2. Footer API
**Endpoint:** `GET /navigation/footer`

**Deskripsi:** Mengambil data link footer per-kategori dan pengaturan brand footer.

**Response:**
```json
{
  "links": {
    "menu-utama": [
      {
        "id": 1,
        "name": "Home",
        "href": "/",
        "target": "_self",
        "order_index": 1
      },
      {
        "id": 2,
        "name": "Profil",
        "href": "/profil",
        "target": "_self",
        "order_index": 2
      }
    ],
    "informasi-akademik": [
      {
        "id": 3,
        "name": "Pimpinan SMP",
        "href": "/profil/pimpinansmp",
        "target": "_self",
        "order_index": 1
      }
    ],
    "sosial": [
      {
        "id": 4,
        "name": "Facebook",
        "href": "https://facebook.com/smpalkautsar",
        "target": "_blank",
        "order_index": 1
      }
    ],
    "lainnya": [
      {
        "id": 5,
        "name": "Kontak",
        "href": "/kontak",
        "target": "_self",
        "order_index": 1
      }
    ]
  },
  "branding": {
    "footer_brand_type": "text",
    "footer_brand_text": "SMP Muhammadiyah Al Kautsar PK Kartasura",
    "footer_brand_image": null
  }
}
```

**Field Response:**
- `links`: Object berisi link footer per-kategori
  - `menu-utama`: Link menu utama website
  - `informasi-akademik`: Link informasi akademik
  - `sosial`: Link media sosial
  - `lainnya`: Link kategori lainnya
- `branding`: Pengaturan branding footer
  - `footer_brand_type`: Tipe brand (`text` atau `image`)
  - `footer_brand_text`: Teks brand (jika tipe text)
  - `footer_brand_image`: URL gambar brand (jika tipe image)

## Dashboard Filament

### 1. Mengelola Navbar/Header
**Lokasi:** Admin Panel → Pengaturan → Navbar/Header

**Fitur:**
- Tambah item menu baru
- Edit menu yang ada
- Hapus menu
- Atur dropdown (parent-child relationship)
- Atur urutan tampilan
- Toggle aktif/nonaktif

**Cara Membuat Dropdown:**
1. Buat menu induk (contoh: "Tentang Kami")
2. Buat menu anak dengan memilih parent di field "Parent (Dropdown)"
3. Atur urutan dengan field "Urutan"

### 2. Mengelola Marquee Header
**Lokasi:** Admin Panel → Pengaturan → Marquee Header

**Fitur:**
- Tambah teks marquee baru
- Edit teks yang ada
- Hapus teks
- Atur warna teks dengan color picker
- Atur kecepatan scroll (slow, normal, fast)
- Atur urutan tampilan
- Toggle aktif/nonaktif

**Pengaturan Kecepatan:**
- `slow`: 20 detik per cycle
- `normal`: 15 detik per cycle  
- `fast`: 10 detik per cycle

### 3. Mengelola Footer
**Lokasi:** Admin Panel → Pengaturan → Footer

**Fitur:**
- Tambah link footer baru
- Edit link yang ada
- Hapus link
- Pilih kategori link
- Atur urutan tampilan
- Toggle aktif/nonaktif

**Kategori Footer:**
- `menu-utama`: Menu utama website
- `informasi-akademik`: Informasi akademik
- `sosial`: Media sosial
- `lainnya`: Kategori lainnya

### 4. Mengelola Branding Situs
**Lokasi:** Admin Panel → Pengaturan → Branding Situs

**Fitur:**
- Upload logo header
- Pilih tipe brand footer (text/image)
- Input teks brand footer
- Upload gambar brand footer

## Implementasi Frontend

### 1. Header Component dengan Marquee

```jsx
import { useState, useEffect } from 'react';
import Image from 'next/image';

function Header() {
  const [headerData, setHeaderData] = useState({
    menu: [],
    branding: {},
    marquee: []
  });
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetch('/api/v1/navigation/header')
      .then(res => res.json())
      .then(data => {
        setHeaderData(data);
        setLoading(false);
      })
      .catch(err => {
        console.error('Error fetching header data:', err);
        setLoading(false);
      });
  }, []);

  if (loading) return <div>Loading...</div>;

  return (
    <header className="w-full">
      {/* Marquee Section */}
      {headerData.marquee && headerData.marquee.length > 0 && (
        <div className="bg-blue-600 text-white py-2 overflow-hidden">
          <div className="marquee-container">
            {headerData.marquee.map((item, index) => (
              <span 
                key={index}
                className="marquee-item"
                style={{ 
                  color: item.color,
                  animationDuration: item.speed === 'slow' ? '20s' : 
                                    item.speed === 'fast' ? '10s' : '15s'
                }}
              >
                {item.text}
              </span>
            ))}
          </div>
        </div>
      )}

      {/* Main Header */}
      <div className="bg-blue-700 text-white px-4 py-3">
        <div className="container mx-auto flex items-center justify-between">
          {/* Logo */}
          {headerData.branding?.header_logo && (
            <div className="flex items-center">
              <Image
                src={headerData.branding.header_logo}
                alt="Logo"
                width={40}
                height={40}
                className="mr-3"
              />
              <span className="text-xl font-bold">KAUTSAR</span>
            </div>
          )}

          {/* Navigation Menu */}
          <nav className="hidden md:flex space-x-6">
            {headerData.menu.map((item) => (
              <div key={item.id} className="relative group">
                <a
                  href={item.href}
                  target={item.target}
                  className="hover:text-blue-200 transition-colors"
                >
                  {item.name}
                  {item.dropdown.length > 0 && (
                    <span className="ml-1">▼</span>
                  )}
                </a>

                {/* Dropdown Menu */}
                {item.dropdown.length > 0 && (
                  <div className="absolute top-full left-0 bg-white text-gray-800 shadow-lg rounded-md py-2 min-w-[200px] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                    {item.dropdown.map((subItem) => (
                      <a
                        key={subItem.id}
                        href={subItem.href}
                        target={subItem.target}
                        className="block px-4 py-2 hover:bg-gray-100 transition-colors"
                      >
                        {subItem.name}
                      </a>
                    ))}
                  </div>
                )}
              </div>
            ))}
          </nav>

          {/* CTA Button */}
          <button className="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded transition-colors">
            Info PPDB
          </button>
        </div>
      </div>
    </header>
  );
}

export default Header;
```

### 2. Footer Component

```jsx
import { useState, useEffect } from 'react';
import Image from 'next/image';

function Footer() {
  const [footerData, setFooterData] = useState({
    links: {},
    branding: {}
  });
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetch('/api/v1/navigation/footer')
      .then(res => res.json())
      .then(data => {
        setFooterData(data);
        setLoading(false);
      })
      .catch(err => {
        console.error('Error fetching footer data:', err);
        setLoading(false);
      });
  }, []);

  if (loading) return <div>Loading...</div>;

  return (
    <footer className="bg-gray-800 text-white py-12">
      <div className="container mx-auto px-4">
        <div className="grid grid-cols-1 md:grid-cols-4 gap-8">
          {/* Menu Utama */}
          <div>
            <h3 className="text-lg font-semibold mb-4">Menu Utama</h3>
            <ul className="space-y-2">
              {footerData.links['menu-utama']?.map((link) => (
                <li key={link.id}>
                  <a
                    href={link.href}
                    target={link.target}
                    className="hover:text-blue-300 transition-colors"
                  >
                    {link.name}
                  </a>
                </li>
              ))}
            </ul>
          </div>

          {/* Informasi Akademik */}
          <div>
            <h3 className="text-lg font-semibold mb-4">Informasi Akademik</h3>
            <ul className="space-y-2">
              {footerData.links['informasi-akademik']?.map((link) => (
                <li key={link.id}>
                  <a
                    href={link.href}
                    target={link.target}
                    className="hover:text-blue-300 transition-colors"
                  >
                    {link.name}
                  </a>
                </li>
              ))}
            </ul>
          </div>

          {/* Media Sosial */}
          <div>
            <h3 className="text-lg font-semibold mb-4">Media Sosial</h3>
            <ul className="space-y-2">
              {footerData.links['sosial']?.map((link) => (
                <li key={link.id}>
                  <a
                    href={link.href}
                    target={link.target}
                    className="hover:text-blue-300 transition-colors"
                  >
                    {link.name}
                  </a>
                </li>
              ))}
            </ul>
          </div>

          {/* Lainnya */}
          <div>
            <h3 className="text-lg font-semibold mb-4">Lainnya</h3>
            <ul className="space-y-2">
              {footerData.links['lainnya']?.map((link) => (
                <li key={link.id}>
                  <a
                    href={link.href}
                    target={link.target}
                    className="hover:text-blue-300 transition-colors"
                  >
                    {link.name}
                  </a>
                </li>
              ))}
            </ul>
          </div>
        </div>

        {/* Brand Footer */}
        <div className="border-t border-gray-700 mt-8 pt-8 text-center">
          {footerData.branding?.footer_brand_type === 'image' && 
           footerData.branding?.footer_brand_image ? (
            <Image
              src={footerData.branding.footer_brand_image}
              alt="Brand Footer"
              width={200}
              height={60}
              className="mx-auto"
            />
          ) : (
            <p className="text-lg font-semibold">
              {footerData.branding?.footer_brand_text || 'SMP Muhammadiyah Al Kautsar PK Kartasura'}
            </p>
          )}
        </div>
      </div>
    </footer>
  );
}

export default Footer;
```

### 3. CSS untuk Marquee

```css
/* Tambahkan CSS ini ke file CSS global Anda */
.marquee-container {
  white-space: nowrap;
  overflow: hidden;
  position: relative;
}

.marquee-item {
  display: inline-block;
  padding: 0 20px;
  animation: marquee linear infinite;
  white-space: nowrap;
}

@keyframes marquee {
  0% { 
    transform: translateX(100%); 
  }
  100% { 
    transform: translateX(-100%); 
  }
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .marquee-item {
    padding: 0 15px;
    font-size: 14px;
  }
}
```

### 4. Tailwind CSS Classes

Jika menggunakan Tailwind CSS, tambahkan konfigurasi custom untuk animasi marquee:

```javascript
// tailwind.config.js
module.exports = {
  theme: {
    extend: {
      animation: {
        'marquee-slow': 'marquee 20s linear infinite',
        'marquee-normal': 'marquee 15s linear infinite',
        'marquee-fast': 'marquee 10s linear infinite',
      },
      keyframes: {
        marquee: {
          '0%': { transform: 'translateX(100%)' },
          '100%': { transform: 'translateX(-100%)' },
        },
      },
    },
  },
  plugins: [],
}
```

## Setup dan Konfigurasi

### 1. Database Migration
```bash
php artisan migrate
```

### 2. Seed Data Default
```bash
php artisan db:seed --class=MarqueeTextSeeder
```

### 3. Storage Link
```bash
php artisan storage:link
```

### 4. Clear Cache
```bash
php artisan optimize:clear
```

## Troubleshooting

### 1. Gambar Tidak Muncul
- Pastikan `php artisan storage:link` sudah dijalankan
- Cek permission folder `storage/app/public`
- Pastikan `APP_URL` di `.env` sudah benar

### 2. API Error
- Jalankan `php artisan route:clear`
- Cek log error di `storage/logs/laravel.log`
- Pastikan semua migration sudah dijalankan

### 3. Marquee Tidak Berjalan
- Pastikan CSS animation sudah dimuat
- Cek console browser untuk error JavaScript
- Pastikan data marquee ada di response API

## Catatan Penting

### 1. Performance
- Gunakan `useMemo` atau `useCallback` untuk optimasi React
- Implementasikan lazy loading untuk gambar
- Cache API response jika diperlukan

### 2. SEO
- Pastikan semua link memiliki `href` yang valid
- Gunakan `alt` text yang deskriptif untuk gambar
- Implementasikan structured data jika diperlukan

### 3. Mobile Responsiveness
- Test dropdown menu di mobile
- Pastikan marquee readable di layar kecil
- Gunakan hamburger menu untuk mobile

### 4. Accessibility
- Tambahkan `aria-label` untuk dropdown
- Pastikan keyboard navigation berfungsi
- Gunakan semantic HTML elements

Dokumentasi ini sudah lengkap dengan sistem marquee yang baru. Sekarang Anda bisa implementasi header dengan marquee scrolling, navbar dengan dropdown, dan footer yang dinamis di frontend Next.js Anda! 
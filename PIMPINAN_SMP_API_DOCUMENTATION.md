# Dokumentasi API Pimpinan SMP

## Overview
API ini menyediakan endpoint untuk mengelola data pimpinan SMP, box keunggulan kepemimpinan, dan pengaturan halaman pimpinan SMP.

## Base URL
```
http://localhost:8000/api/v1
```

## Authentication
Saat ini API tidak memerlukan authentication untuk endpoint GET.

## Endpoints

### 1. Pimpinan SMP

#### 1.1 Get All Pimpinan SMP
**GET** `/pimpinan-smp`

Mengambil semua data pimpinan SMP yang aktif.

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Muhammad Rifqi Nugroho, M.Pd.",
      "position": "Kepala Sekolah SMP Muhammadiyah Al Kautsar PK Kartasura",
      "photo": "http://localhost:8000/storage/pimpinan-smp/photo.jpg",
      "bio": "Kepala Sekolah yang visioner...",
      "education": "S2 Pendidikan",
      "experience": "Lebih dari 10 tahun pengalaman...",
      "type": "Kepala Sekolah",
      "order_index": 1,
      "banner_desktop": "http://localhost:8000/storage/pimpinan-smp/banners/banner.jpg",
      "banner_mobile": "http://localhost:8000/storage/pimpinan-smp/banners/banner-mobile.jpg"
    }
  ]
}
```

#### 1.2 Get Pimpinan SMP by ID
**GET** `/pimpinan-smp/{id}`

Mengambil data pimpinan SMP berdasarkan ID.

**Parameters:**
- `id` (integer) - ID pimpinan SMP

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "name": "Muhammad Rifqi Nugroho, M.Pd.",
    "position": "Kepala Sekolah SMP Muhammadiyah Al Kautsar PK Kartasura",
    "photo": "http://localhost:8000/storage/pimpinan-smp/photo.jpg",
    "bio": "Kepala Sekolah yang visioner...",
    "education": "S2 Pendidikan",
    "experience": "Lebih dari 10 tahun pengalaman...",
    "type": "Kepala Sekolah",
    "order_index": 1,
    "banner_desktop": "http://localhost:8000/storage/pimpinan-smp/banners/banner.jpg",
    "banner_mobile": "http://localhost:8000/storage/pimpinan-smp/banners/banner-mobile.jpg"
  }
}
```

#### 1.3 Get Pimpinan SMP by Type
**GET** `/pimpinan-smp/type/{type}`

Mengambil data pimpinan SMP berdasarkan tipe jabatan (menggunakan LIKE search).

**Parameters:**
- `type` (string) - Tipe jabatan (contoh: "Kepala Sekolah", "Wakil Kepala Sekolah", "Kurikulum", dll.)

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Muhammad Rifqi Nugroho, M.Pd.",
      "position": "Kepala Sekolah SMP Muhammadiyah Al Kautsar PK Kartasura",
      "photo": "http://localhost:8000/storage/pimpinan-smp/photo.jpg",
      "bio": "Kepala Sekolah yang visioner...",
      "education": "S2 Pendidikan",
      "experience": "Lebih dari 10 tahun pengalaman...",
      "type": "Kepala Sekolah",
      "order_index": 1,
      "banner_desktop": "http://localhost:8000/storage/pimpinan-smp/banners/banner.jpg",
      "banner_mobile": "http://localhost:8000/storage/pimpinan-smp/banners/banner-mobile.jpg"
    }
  ]
}
```

#### 1.4 Get Kepala Sekolah
**GET** `/pimpinan-smp/kepala-sekolah`

Mengambil data kepala sekolah (mencari berdasarkan "Kepala Sekolah" dalam field type).

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Muhammad Rifqi Nugroho, M.Pd.",
      "position": "Kepala Sekolah SMP Muhammadiyah Al Kautsar PK Kartasura",
      "photo": "http://localhost:8000/storage/pimpinan-smp/photo.jpg",
      "bio": "Kepala Sekolah yang visioner...",
      "education": "S2 Pendidikan",
      "experience": "Lebih dari 10 tahun pengalaman...",
      "type": "Kepala Sekolah",
      "order_index": 1,
      "banner_desktop": "http://localhost:8000/storage/pimpinan-smp/banners/banner.jpg",
      "banner_mobile": "http://localhost:8000/storage/pimpinan-smp/banners/banner-mobile.jpg"
    }
  ]
}
```

#### 1.5 Get Wakil Kepala Sekolah
**GET** `/pimpinan-smp/wakil-kepala-sekolah`

Mengambil data semua wakil kepala sekolah (mencari berdasarkan "Wakil Kepala Sekolah" dalam field type).

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 2,
      "name": "Irma Rachmawati, S.Pd.",
      "position": "Wakil Kepala Sekolah Bidang Kurikulum SMP Muhammadiyah Al Kautsar PK Kartasura",
      "photo": "http://localhost:8000/storage/pimpinan-smp/photo.jpg",
      "bio": "Wakil Kepala Sekolah yang fokus...",
      "education": "S1 Pendidikan",
      "experience": "Pengalaman dalam pengembangan kurikulum...",
      "type": "Wakil Kepala Sekolah Kurikulum",
      "order_index": 2,
      "banner_desktop": "http://localhost:8000/storage/pimpinan-smp/banners/banner.jpg",
      "banner_mobile": "http://localhost:8000/storage/pimpinan-smp/banners/banner-mobile.jpg"
    }
  ]
}
```

### 2. Box Keunggulan Kepemimpinan

#### 2.1 Get All Boxes
**GET** `/pimpinan-smp/boxes`

Mengambil semua data box keunggulan kepemimpinan.

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "title": "Kepemimpinan Visioner",
      "description": "Memiliki visi jangka panjang untuk mengembangkan sekolah menjadi institusi pendidikan terdepan.",
      "icon": "👨‍💼",
      "image": "http://localhost:8000/storage/pimpinan-smp-boxes/image.jpg",
      "background_color": "green-600",
      "order_index": 1
    }
  ]
}
```

### 3. Settings

#### 3.1 Get Settings
**GET** `/pimpinan-smp/settings`

Mengambil pengaturan halaman pimpinan SMP.

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "title": "Pimpinan SMP Muhammadiyah Al Kautsar PK Kartasura",
    "subtitle": "Kepemimpinan yang visioner dan berpengalaman dalam mengembangkan pendidikan berkualitas dengan nilai-nilai Islami.",
    "banner_desktop": "http://localhost:8000/storage/pimpinan-smp-settings/banner.jpg",
    "banner_mobile": "http://localhost:8000/storage/pimpinan-smp-settings/banner-mobile.jpg",
    "keunggulan_title": "Keunggulan Kepemimpinan SMP Muhammadiyah Al Kautsar PK Kartasura",
    "keunggulan_subtitle": "Tim pimpinan yang handal dan berpengalaman dalam mengelola sekolah"
  }
}
```

### 4. Complete Data

#### 4.1 Get Complete Data
**GET** `/pimpinan-smp/complete`

Mengambil semua data lengkap (settings, pimpinan, dan boxes) dalam satu request.

**Response:**
```json
{
  "success": true,
  "data": {
    "settings": {
      "id": 1,
      "title": "Pimpinan SMP Muhammadiyah Al Kautsar PK Kartasura",
      "subtitle": "Kepemimpinan yang visioner dan berpengalaman...",
      "banner_desktop": "http://localhost:8000/storage/pimpinan-smp-settings/banner.jpg",
      "banner_mobile": "http://localhost:8000/storage/pimpinan-smp-settings/banner-mobile.jpg",
      "keunggulan_title": "Keunggulan Kepemimpinan SMP Muhammadiyah Al Kautsar PK Kartasura",
      "keunggulan_subtitle": "Tim pimpinan yang handal dan berpengalaman..."
    },
    "pimpinan": [
      {
        "id": 1,
        "name": "Muhammad Rifqi Nugroho, M.Pd.",
        "position": "Kepala Sekolah SMP Muhammadiyah Al Kautsar PK Kartasura",
        "photo": "http://localhost:8000/storage/pimpinan-smp/photo.jpg",
        "bio": "Kepala Sekolah yang visioner...",
        "education": "S2 Pendidikan",
        "experience": "Lebih dari 10 tahun pengalaman...",
        "type": "Kepala Sekolah",
        "order_index": 1,
        "banner_desktop": "http://localhost:8000/storage/pimpinan-smp/banners/banner.jpg",
        "banner_mobile": "http://localhost:8000/storage/pimpinan-smp/banners/banner-mobile.jpg"
      }
    ],
    "boxes": [
      {
        "id": 1,
        "title": "Kepemimpinan Visioner",
        "description": "Memiliki visi jangka panjang untuk mengembangkan sekolah...",
        "icon": "👨‍💼",
        "image": "http://localhost:8000/storage/pimpinan-smp-boxes/image.jpg",
        "background_color": "green-600",
        "order_index": 1
      }
    ]
  }
}
```

## Error Responses

### 404 Not Found
```json
{
  "success": false,
  "message": "Pimpinan SMP not found",
  "error": "No query results for model [App\\Models\\PimpinanSMP] 1"
}
```

### 500 Internal Server Error
```json
{
  "success": false,
  "message": "Failed to fetch pimpinan SMP",
  "error": "Error details..."
}
```

## Data Types

### Pimpinan SMP Types (Fleksibel)
Field `type` sekarang menggunakan string biasa, sehingga Anda bisa menulis jabatan sesuai keinginan. Contoh:
- `Kepala Sekolah`
- `Wakil Kepala Sekolah Kurikulum`
- `Wakil Kepala Sekolah Kesiswaan`
- `Wakil Kepala Sekolah SDM & Humas`
- `Wakil Kepala Sekolah AIK`
- `Wakil Kepala Sekolah Sarana Prasarana`
- `Kepala Bagian Akademik`
- `Kepala Bagian Administrasi`
- Dan lain-lain sesuai kebutuhan

### Background Colors
- `green-600` - Hijau
- `green-700` - Hijau Tua
- `blue-600` - Biru
- `blue-700` - Biru Tua
- `purple-600` - Ungu
- `purple-700` - Ungu Tua

## Usage Examples

### Frontend Integration

#### React/Next.js Example
```javascript
// Fetch complete data
const fetchPimpinanSMPData = async () => {
  try {
    const response = await fetch('/api/v1/pimpinan-smp/complete');
    const data = await response.json();
    
    if (data.success) {
      const { settings, pimpinan, boxes } = data.data;
      // Use the data in your component
      console.log('Settings:', settings);
      console.log('Pimpinan:', pimpinan);
      console.log('Boxes:', boxes);
    }
  } catch (error) {
    console.error('Error fetching data:', error);
  }
};

// Fetch specific pimpinan by type
const fetchKepalaSekolah = async () => {
  try {
    const response = await fetch('/api/v1/pimpinan-smp/kepala-sekolah');
    const data = await response.json();
    
    if (data.success) {
      const kepalaSekolah = data.data[0];
      // Use kepala sekolah data
      console.log('Kepala Sekolah:', kepalaSekolah);
    }
  } catch (error) {
    console.error('Error fetching kepala sekolah:', error);
  }
};

// Search pimpinan by custom type
const fetchPimpinanByType = async (type) => {
  try {
    const response = await fetch(`/api/v1/pimpinan-smp/type/${encodeURIComponent(type)}`);
    const data = await response.json();
    
    if (data.success) {
      console.log('Pimpinan found:', data.data);
    }
  } catch (error) {
    console.error('Error fetching pimpinan by type:', error);
  }
};
```

#### Axios Example
```javascript
import axios from 'axios';

const API_BASE_URL = 'http://localhost:8000/api/v1';

// Fetch all pimpinan
const getAllPimpinan = async () => {
  try {
    const response = await axios.get(`${API_BASE_URL}/pimpinan-smp`);
    return response.data.data;
  } catch (error) {
    console.error('Error:', error);
    throw error;
  }
};

// Fetch settings
const getSettings = async () => {
  try {
    const response = await axios.get(`${API_BASE_URL}/pimpinan-smp/settings`);
    return response.data.data;
  } catch (error) {
    console.error('Error:', error);
    throw error;
  }
};

// Search by custom type
const searchPimpinanByType = async (type) => {
  try {
    const response = await axios.get(`${API_BASE_URL}/pimpinan-smp/type/${encodeURIComponent(type)}`);
    return response.data.data;
  } catch (error) {
    console.error('Error:', error);
    throw error;
  }
};
```

## Admin Panel Features

### Fleksibilitas Jabatan
Sekarang di admin panel, field "Jabatan" menggunakan **TextInput** sehingga Anda bisa:
- Menulis jabatan sesuai keinginan
- Tidak terbatas pada pilihan yang sudah ditentukan
- Menambah jabatan baru kapan saja
- Mengubah jabatan yang sudah ada

### Contoh Jabatan yang Bisa Ditulis:
- `Kepala Sekolah`
- `Wakil Kepala Sekolah Kurikulum`
- `Wakil Kepala Sekolah Kesiswaan`
- `Kepala Bagian Akademik`
- `Kepala Bagian Administrasi`
- `Kepala Bagian Keuangan`
- `Kepala Bagian Sarana Prasarana`
- `Kepala Bagian Humas`
- `Kepala Bagian IT`
- Dan lain-lain sesuai kebutuhan sekolah

## Notes

1. **Image URLs**: Semua URL gambar akan otomatis menggunakan base URL storage Laravel
2. **Ordering**: Data diurutkan berdasarkan `order_index` dan kemudian `id`
3. **Active Status**: Hanya data dengan `is_active = true` yang akan dikembalikan
4. **Error Handling**: Semua endpoint menggunakan try-catch dan mengembalikan response yang konsisten
5. **File Storage**: Pastikan storage link sudah dibuat dengan menjalankan `php artisan storage:link`
6. **Flexible Types**: Field `type` sekarang fleksibel dan bisa ditulis sesuai keinginan
7. **Search Functionality**: Endpoint `/type/{type}` menggunakan LIKE search untuk mencari jabatan

## Admin Panel

Untuk mengelola data, gunakan Filament Admin Panel:

1. **Pimpinan SMP**: `/admin/pimpinan-s-m-p-s`
2. **Box Keunggulan**: `/admin/pimpinan-s-m-p-boxes`
3. **Pengaturan**: `/admin/pimpinan-s-m-p-settings`

Semua resource berada dalam grup "Profil Sekolah" di sidebar admin. 
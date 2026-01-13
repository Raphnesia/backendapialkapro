# Panduan Manajemen Data Guru

## Fitur yang Telah Disediakan

### 1. Dashboard Filament (Admin Panel)
- **Akses**: `/admin/teachers`
- **Fitur**:
  - Tambah guru baru
  - Edit data guru
  - Hapus guru
  - Upload foto guru
  - Atur urutan tampilan
  - Aktif/non-aktifkan guru

### 2. Field yang Tersedia
| Field | Label | Deskripsi |
|-------|--------|-----------|
| `name` | Nama Lengkap | Nama guru |
| `position` | Jabatan | Posisi/jabatan guru |
| `bio` | Biografi | Deskripsi/detail guru |
| `photo` | Foto | Upload foto guru |
| `subject` | Mata Pelajaran | Mapel yang diampu |
| `education` | Pendidikan Terakhir | Riwayat pendidikan |
| `experience` | Pengalaman | Pengalaman mengajar |
| `order_index` | Urutan | Urutan tampilan |
| `is_active` | Status | Aktif/tidak aktif |

### 3. API Endpoints untuk Frontend

#### Get Teachers Grouped by Subject
```
GET /api/v1/teachers/by-subject
```

**Response Format** (sesuai dengan frontend):
```json
{
  "matematika": [
    {
      "name": "Dr. Ahmad Susanto, M.Pd.",
      "image": "http://localhost:8000/storage/teachers/photo1.jpg",
      "position": "Guru Matematika Senior",
      "description": "Berpengalaman 15 tahun...",
      "subject": "Matematika"
    }
  ],
  "bahasa_indonesia": [
    {
      "name": "Prof. Bambang Sutrisno, M.Pd.",
      "image": "http://localhost:8000/storage/teachers/photo2.jpg",
      "position": "Guru Bahasa Indonesia Senior",
      "description": "Ahli dalam sastra Indonesia...",
      "subject": "Bahasa Indonesia"
    }
  ]
}
```

#### Get All Teachers (General)
```
GET /api/v1/teachers
GET /api/v1/teachers/list (hanya guru)
GET /api/v1/staff/list (hanya staff)
```

### 4. Mapping Frontend ↔ Backend
| Frontend Field | Backend Field |
|----------------|---------------|
| `name` | `name` |
| `image` | `photo` |
| `position` | `position` |
| `description` | `bio` |
| `subject` | `subject` |

### 5. Cara Menggunakan

#### Menambah Guru Baru:
1. Masuk ke Dashboard Filament: `/admin`
2. Klik menu "Guru & Staff"
3. Klik tombol "Buat Guru/Staff"
4. Isi form dengan lengkap
5. Upload foto guru
6. Simpan data

#### Mengedit Data Guru:
1. Masuk ke Dashboard Filament: `/admin`
2. Klik menu "Guru & Staff"
3. Klik nama guru yang ingin diedit
4. Edit data yang diperlukan
5. Simpan perubahan

#### Menghapus Guru:
1. Masuk ke Dashboard Filament: `/admin`
2. Klik menu "Guru & Staff"
3. Klik tombol hapus (🗑️) di kolom aksi

### 6. Tips
- Gunakan foto dengan ukuran optimal (max 2MB)
- Isi field "Urutan" untuk mengatur tampilan
- Gunakan status "Aktif" untuk menampilkan guru di frontend
- Mata pelajaran otomatis dikelompokkan di frontend

### 7. Subjects yang Tersedia
- Matematika
- Bahasa Indonesia
- Bahasa Inggris
- IPA
- IPS
- Seni Budaya
- Pendidikan Jasmani
- Teknologi Informasi
- Pendidikan Agama Islam
- PKN
- Prakarya
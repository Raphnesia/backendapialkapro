# Profil API Documentation

## Overview
API untuk mengelola pengaturan halaman profil sekolah, termasuk banner desktop/mobile, title, subtitle, dan konten lainnya.

## Base URL
```
http://localhost:8000/api/v1
```

## Endpoints

### 1. Get Profil Settings
**GET** `/profil/settings`

Mengambil semua pengaturan halaman profil.

#### Response Success (200)
```json
{
    "success": true,
    "message": "Profile settings retrieved successfully",
    "data": {
        "title": "Profil SMP Muhammadiyah Al Kautsar PK Kartasura",
        "subtitle": "Informasi lengkap tentang sekolah kami",
        "banner_desktop": "/storage/profil/banners/filename.jpg",
        "banner_mobile": "/storage/profil/banners/filename.jpg",
        "description": "SMP Muhammadiyah Al Kautsar PK Kartasura merupakan lembaga pendidikan...",
        "meta_description": "Profil lengkap SMP Muhammadiyah Al Kautsar PK Kartasura...",
        "meta_keywords": "profil, smp, muhammadiyah, al kautsar, kartasura, sekolah, pendidikan, islam",
        "is_active": true
    }
}
```

#### Response Error (404)
```json
{
    "success": false,
    "message": "Profile settings not found",
    "data": null
}
```

### 2. Update Profil Settings
**POST** `/profil/settings`

Mengupdate pengaturan halaman profil.

#### Request Body
```json
{
    "title": "Profil SMP Muhammadiyah Al Kautsar PK Kartasura",
    "subtitle": "Informasi lengkap tentang sekolah kami",
    "banner_desktop": "profil/banners/filename.jpg",
    "banner_mobile": "profil/banners/filename.jpg",
    "description": "Deskripsi profil sekolah...",
    "meta_description": "Meta description untuk SEO",
    "meta_keywords": "keyword1, keyword2, keyword3",
    "is_active": true
}
```

#### Response Success (200)
```json
{
    "success": true,
    "message": "Profile settings updated successfully",
    "data": {
        "id": 1,
        "title": "Profil SMP Muhammadiyah Al Kautsar PK Kartasura",
        "subtitle": "Informasi lengkap tentang sekolah kami",
        "banner_desktop": "profil/banners/filename.jpg",
        "banner_mobile": "profil/banners/filename.jpg",
        "description": "Deskripsi profil sekolah...",
        "meta_description": "Meta description untuk SEO",
        "meta_keywords": "keyword1, keyword2, keyword3",
        "is_active": true,
        "created_at": "2025-08-11T14:54:51.000000Z",
        "updated_at": "2025-08-11T14:54:51.000000Z"
    }
}
```

## Database Schema

### Table: `profil_settings`

| Column | Type | Nullable | Default | Description |
|--------|------|----------|---------|-------------|
| `id` | bigint | false | auto_increment | Primary key |
| `title` | varchar(255) | false | - | Judul banner halaman profil |
| `subtitle` | text | false | - | Subtitle banner halaman profil |
| `banner_desktop` | varchar(255) | true | null | Path gambar banner desktop |
| `banner_mobile` | varchar(255) | true | null | Path gambar banner mobile |
| `description` | longtext | true | null | Deskripsi lengkap profil sekolah |
| `meta_description` | text | true | null | Meta description untuk SEO |
| `meta_keywords` | text | true | null | Meta keywords untuk SEO |
| `is_active` | boolean | false | true | Status aktif pengaturan |
| `created_at` | timestamp | true | null | Waktu pembuatan |
| `updated_at` | timestamp | true | null | Waktu update terakhir |

## File Storage

### Directory Structure
```
storage/app/public/
├── profil/
│   └── banners/
│       ├── desktop-banner.jpg
│       └── mobile-banner.jpg
```

### Image Requirements
- **Format**: JPG, PNG, WebP
- **Max Size**: 10MB
- **Recommended Resolution**: 
  - Desktop: 1920x1080px (16:9)
  - Mobile: 1080x1920px (9:16)

## Frontend Integration

### 1. Fetch Profil Settings
```javascript
// Fetch profil settings
const fetchProfilSettings = async () => {
    try {
        const response = await fetch('/api/v1/profil/settings');
        const data = await response.json();
        
        if (data.success) {
            return data.data;
        } else {
            throw new Error(data.message);
        }
    } catch (error) {
        console.error('Error fetching profil settings:', error);
        return null;
    }
};
```

### 2. Update Profil Settings
```javascript
// Update profil settings
const updateProfilSettings = async (settings) => {
    try {
        const response = await fetch('/api/v1/profil/settings', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(settings)
        });
        
        const data = await response.json();
        
        if (data.success) {
            return data.data;
        } else {
            throw new Error(data.message);
        }
    } catch (error) {
        console.error('Error updating profil settings:', error);
        return null;
    }
};
```

### 3. React Component Example
```jsx
import { useState, useEffect } from 'react';
import Image from 'next/image';

export default function ProfilPage() {
    const [profilData, setProfilData] = useState(null);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        const loadProfilData = async () => {
            const data = await fetchProfilSettings();
            setProfilData(data);
            setLoading(false);
        };
        
        loadProfilData();
    }, []);

    if (loading) {
        return <div>Loading...</div>;
    }

    if (!profilData) {
        return <div>Error loading profil data</div>;
    }

    return (
        <div className="min-h-screen flex flex-col">
            {/* Banner Section */}
            <div className="relative w-full md:h-screen h-64">
                {/* Desktop Banner */}
                {profilData.banner_desktop && (
                    <Image 
                        src={profilData.banner_desktop}
                        alt="Profil Banner Desktop"
                        fill
                        className="object-cover hidden md:block"
                        priority
                        sizes="100vw"
                        quality={75}
                    />
                )}
                
                {/* Mobile Banner */}
                {profilData.banner_mobile && (
                    <div className="relative w-full h-full md:hidden">
                        <Image 
                            src={profilData.banner_mobile}
                            alt="Profil Banner Mobile"
                            fill
                            className="object-cover"
                            priority
                            sizes="100vw"
                            quality={75}
                        />
                    </div>
                )}
                
                {/* Overlay Content */}
                <div className="absolute inset-0 flex items-end">
                    <div className="w-full bg-gradient-to-t from-black/80 via-black/40 to-transparent">
                        <div className="container mx-auto px-8 pb-16">
                            <div className="max-w-3xl">
                                <div className="bg-green-500 inline-flex p-5">
                                    <h1 className="text-2xl md:text-3xl font-bold text-white">
                                        {profilData.title}
                                    </h1>
                                </div>
                                <div className="bg-green-700 p-4 opacity-90 inline-flex rounded-b-lg">
                                    <p className="text-white text-sm md:text-lg font-semibold">
                                        {profilData.subtitle}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {/* Content Section */}
            <main className="flex-grow container mx-auto px-4 py-8 bg-white">
                <h1 className="text-3xl font-bold text-primary mb-6">
                    {profilData.title}
                </h1>
                
                <div className="prose max-w-none">
                    <p className="text-lg mb-4">
                        {profilData.description}
                    </p>
                    
                    {/* Navigation Cards */}
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
                        {/* Navigation cards content */}
                    </div>
                </div>
            </main>
        </div>
    );
}
```

## Admin Dashboard

### Filament Resource
- **Navigation**: Profile Management > Profil Settings
- **Features**:
  - CRUD untuk pengaturan profil
  - Upload banner desktop/mobile
  - Pengaturan SEO
  - Toggle aktif/nonaktif

### Access
- Login ke admin panel: `/admin`
- Navigasi: Profile Management > Profil Settings

## Error Handling

### Common Errors
1. **404 - Profile settings not found**
   - Solusi: Jalankan seeder atau buat record manual

2. **422 - Validation error**
   - Solusi: Periksa format data yang dikirim

3. **500 - Server error**
   - Solusi: Periksa log Laravel dan konfigurasi

## Testing

### Test API Endpoints
```bash
# Test GET endpoint
curl -X GET http://localhost:8000/api/v1/profil/settings

# Test POST endpoint
curl -X POST http://localhost:8000/api/v1/profil/settings \
  -H "Content-Type: application/json" \
  -d '{
    "title": "Test Title",
    "subtitle": "Test Subtitle",
    "is_active": true
  }'
```

### Test File Upload
1. Upload gambar melalui admin panel
2. Verifikasi file tersimpan di `storage/app/public/profil/banners/`
3. Test akses gambar via URL: `/storage/profil/banners/filename.jpg`

## Maintenance

### Backup
- Backup database table `profil_settings`
- Backup file gambar di `storage/app/public/profil/`

### Monitoring
- Monitor ukuran file upload
- Monitor penggunaan storage
- Log perubahan pengaturan

## Version History

- **v1.0** - Initial release with basic CRUD operations
- **v1.1** - Added SEO fields and status toggle
- **v1.2** - Enhanced file upload with image editor

## Support

Untuk bantuan teknis atau pertanyaan, silakan hubungi tim development.

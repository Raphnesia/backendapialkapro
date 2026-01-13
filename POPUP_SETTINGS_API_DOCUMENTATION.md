# Popup Settings API Documentation

## Overview
API untuk mengkonfigurasi popup welcome yang muncul di homepage website. Popup dapat dikonfigurasi melalui backend dengan berbagai opsi seperti gambar, link, delay, dan pengaturan tampilan.

## Base URL
```
https://api.alkapro.id/api/v1
```

## Endpoint

### GET `/api/v1/popup-settings`

Mengambil konfigurasi popup yang aktif.

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "is_active": true,
    "image_url": "https://api.alkapro.id/storage/popup/popup-image.jpg",
    "image_alt": "Welcome Popup",
    "link_url": "https://example.com/promotion",
    "open_in_new_tab": true,
    "show_on_first_visit_only": false,
    "delay_before_show": 1000,
    "expires_at": "2025-12-31T23:59:59.000000Z",
    "created_at": "2025-01-01T00:00:00.000000Z",
    "updated_at": "2025-01-15T10:30:00.000000Z"
  }
}
```

**Response jika tidak ada popup aktif:**
```json
{
  "success": true,
  "data": {
    "is_active": false,
    "image_url": ""
  }
}
```

### POST `/api/v1/popup-settings`

Membuat konfigurasi popup baru.

**Request Body:**
```json
{
  "is_active": true,
  "image_url": "https://example.com/popup-image.jpg",
  "image_alt": "Welcome Popup",
  "link_url": "https://example.com/promotion",
  "open_in_new_tab": true,
  "show_on_first_visit_only": false,
  "delay_before_show": 1000,
  "expires_at": "2025-12-31T23:59:59.000000Z"
}
```

**Response:**
```json
{
  "success": true,
  "message": "Popup settings created successfully",
  "data": {
    "id": 1,
    "is_active": true,
    "image_url": "https://api.alkapro.id/storage/popup/popup-image.jpg",
    "image_alt": "Welcome Popup",
    "link_url": "https://example.com/promotion",
    "open_in_new_tab": true,
    "show_on_first_visit_only": false,
    "delay_before_show": 1000,
    "expires_at": "2025-12-31T23:59:59.000000Z",
    "created_at": "2025-01-01T00:00:00.000000Z",
    "updated_at": "2025-01-15T10:30:00.000000Z"
  }
}
```

### PUT `/api/v1/popup-settings/{id}`

Memperbarui konfigurasi popup yang sudah ada.

**Request Body:**
```json
{
  "is_active": true,
  "image_url": "https://example.com/popup-image-updated.jpg",
  "image_alt": "Welcome Popup Updated",
  "link_url": "https://example.com/new-promotion",
  "open_in_new_tab": false,
  "show_on_first_visit_only": true,
  "delay_before_show": 2000,
  "expires_at": "2025-12-31T23:59:59.000000Z"
}
```

**Response:**
```json
{
  "success": true,
  "message": "Popup settings updated successfully",
  "data": {
    "id": 1,
    "is_active": true,
    "image_url": "https://api.alkapro.id/storage/popup/popup-image-updated.jpg",
    "image_alt": "Welcome Popup Updated",
    "link_url": "https://example.com/new-promotion",
    "open_in_new_tab": false,
    "show_on_first_visit_only": true,
    "delay_before_show": 2000,
    "expires_at": "2025-12-31T23:59:59.000000Z",
    "created_at": "2025-01-01T00:00:00.000000Z",
    "updated_at": "2025-01-20T10:30:00.000000Z"
  }
}
```

## Field Descriptions

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `is_active` | boolean | Yes | Menentukan apakah popup aktif atau tidak |
| `image_url` | string | Yes | URL gambar popup (dapat berupa URL eksternal atau path relatif yang akan dikonversi otomatis menjadi URL lengkap) |
| `image_alt` | string | No | Teks alternatif untuk gambar (untuk aksesibilitas) |
| `link_url` | string | No | URL yang akan dibuka ketika popup diklik (opsional) |
| `open_in_new_tab` | boolean | No | Jika true, link akan dibuka di tab baru (default: false) |
| `show_on_first_visit_only` | boolean | No | Jika true, popup hanya muncul sekali per user (menggunakan localStorage) |
| `delay_before_show` | integer | No | Delay dalam milliseconds sebelum popup muncul (default: 0) |
| `expires_at` | datetime | No | Tanggal dan waktu kapan popup akan expire (format: ISO 8601) |

## Frontend Implementation Example

### React/Next.js Example

```typescript
// hooks/usePopupSettings.ts
import { useState, useEffect } from 'react';

interface PopupSettings {
  id: number;
  is_active: boolean;
  image_url: string;
  image_alt?: string;
  link_url?: string;
  open_in_new_tab: boolean;
  show_on_first_visit_only: boolean;
  delay_before_show: number;
  expires_at?: string;
}

export const usePopupSettings = () => {
  const [popupSettings, setPopupSettings] = useState<PopupSettings | null>(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const fetchPopupSettings = async () => {
      try {
        setLoading(true);
        const response = await fetch('https://api.alkapro.id/api/v1/popup-settings');
        const data = await response.json();
        
        if (data.success && data.data.is_active) {
          // Check if popup has expired
          if (data.data.expires_at) {
            const expiresAt = new Date(data.data.expires_at);
            if (expiresAt < new Date()) {
              setPopupSettings(null);
              setLoading(false);
              return;
            }
          }
          
          // Check if should show only on first visit
          if (data.data.show_on_first_visit_only) {
            const hasSeenPopup = localStorage.getItem('has_seen_popup');
            if (hasSeenPopup === 'true') {
              setPopupSettings(null);
              setLoading(false);
              return;
            }
          }
          
          setPopupSettings(data.data);
        } else {
          setPopupSettings(null);
        }
      } catch (err) {
        console.error('Error fetching popup settings:', err);
        setError('Failed to load popup settings');
        // Fallback to default popup
        setPopupSettings({
          id: 0,
          is_active: true,
          image_url: '/popupimage.jpg',
          image_alt: 'Welcome',
          open_in_new_tab: false,
          show_on_first_visit_only: false,
          delay_before_show: 0,
        });
      } finally {
        setLoading(false);
      }
    };

    fetchPopupSettings();
  }, []);

  return { popupSettings, loading, error };
};
```

```tsx
// components/Popup.tsx
'use client';

import { useState, useEffect } from 'react';
import { usePopupSettings } from '@/hooks/usePopupSettings';

export const Popup = () => {
  const { popupSettings, loading } = usePopupSettings();
  const [showPopup, setShowPopup] = useState(false);
  const [hasPlayedSound, setHasPlayedSound] = useState(false);

  useEffect(() => {
    if (!loading && popupSettings && popupSettings.is_active) {
      // Apply delay
      const timer = setTimeout(() => {
        setShowPopup(true);
        
        // Play sound effect
        if (!hasPlayedSound) {
          const audio = new Audio('/popupeffect.mp3');
          audio.play().catch(err => console.log('Audio play failed:', err));
          setHasPlayedSound(true);
        }
      }, popupSettings.delay_before_show || 0);

      return () => clearTimeout(timer);
    }
  }, [popupSettings, loading, hasPlayedSound]);

  const handleClose = () => {
    setShowPopup(false);
    
    // Mark as seen if show_on_first_visit_only is true
    if (popupSettings?.show_on_first_visit_only) {
      localStorage.setItem('has_seen_popup', 'true');
    }
  };

  const handleClick = () => {
    if (popupSettings?.link_url) {
      if (popupSettings.open_in_new_tab) {
        window.open(popupSettings.link_url, '_blank');
      } else {
        window.location.href = popupSettings.link_url;
      }
    } else {
      handleClose();
    }
  };

  if (!showPopup || !popupSettings) {
    return null;
  }

  return (
    <div className="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
      <div className="relative max-w-4xl w-full mx-4">
        <button
          onClick={handleClose}
          className="absolute -top-10 right-0 text-white text-2xl font-bold hover:text-gray-300"
          aria-label="Tutup popup"
        >
          ×
        </button>
        <div
          onClick={handleClick}
          className="cursor-pointer"
        >
          <img
            src={popupSettings.image_url}
            alt={popupSettings.image_alt || 'Popup'}
            className="w-full h-auto rounded-lg shadow-2xl"
          />
        </div>
      </div>
    </div>
  );
};
```

## Notes

- **Image URL**: Backend secara otomatis mengkonversi path storage menjadi URL lengkap. Jika Anda mengupload gambar melalui Filament admin, path akan otomatis dikonversi menjadi URL lengkap.
- **Fallback**: Jika API gagal, frontend dapat fallback ke popup default (`/popupimage.jpg`)
- **LocalStorage**: `show_on_first_visit_only` menggunakan localStorage dengan key `has_seen_popup`
- **Sound Effect**: Frontend dapat memutar sound effect (`/popupeffect.mp3`) ketika popup muncul
- **Expiration**: Popup yang sudah expired tidak akan ditampilkan, meskipun `is_active` adalah `true`
- **Multiple Popups**: Hanya satu popup aktif yang dapat ditampilkan pada satu waktu. Ketika membuat popup baru dengan `is_active: true`, semua popup lain akan otomatis dinonaktifkan.

## Error Handling

Jika terjadi error, API akan mengembalikan response dengan format:

```json
{
  "success": false,
  "message": "Error message",
  "errors": {
    "field_name": ["Error message for field"]
  }
}
```

## Admin Panel

Popup settings dapat dikonfigurasi melalui Filament Admin Panel:
- Login ke admin panel
- Buka menu **Settings** → **Popup Settings**
- Buat popup baru atau edit popup yang sudah ada
- Upload gambar popup melalui form
- Konfigurasi semua pengaturan sesuai kebutuhan

## Testing

Untuk testing API, Anda dapat menggunakan curl atau Postman:

```bash
# Get popup settings
curl -X GET https://api.alkapro.id/api/v1/popup-settings

# Create popup settings
curl -X POST https://api.alkapro.id/api/v1/popup-settings \
  -H "Content-Type: application/json" \
  -d '{
    "is_active": true,
    "image_url": "https://example.com/popup.jpg",
    "image_alt": "Welcome",
    "delay_before_show": 1000
  }'

# Update popup settings
curl -X PUT https://api.alkapro.id/api/v1/popup-settings/1 \
  -H "Content-Type: application/json" \
  -d '{
    "is_active": true,
    "delay_before_show": 2000
  }'
```

# 🎥 Home Hero Video API

## 🔗 Base URL
`http://localhost:8000/api/v1`

## 🧭 Endpoint
- GET `/home-hero-videos` — semua video (aktif/non-aktif) berurutan
- GET `/home-hero-videos/active` — hanya video aktif
- GET `/home-hero-videos/{id}` — detail per id

## 🧩 Skema Data
- `title`: string
- `source_type`: `upload` | `url`
- `video_desktop`: URL MP4 (bisa `storage/...` atau URL penuh)
- `video_mobile`: URL MP4 (mobile)
- `poster_image`: URL gambar poster (opsional)
- `is_active`: boolean
- `order_index`: number

## 📡 Contoh Respons

### 1) Semua video
```http
GET /home-hero-videos
```
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "title": "Digital School, Sekolahku Surgaku",
      "source_type": "upload",
      "video_desktop": "http://localhost:8000/storage/hero-videos/desktop.mp4",
      "video_mobile": "http://localhost:8000/storage/hero-videos/mobile.mp4",
      "poster_image": "http://localhost:8000/storage/hero-videos/posters/poster.jpg",
      "is_active": true,
      "order_index": 1
    }
  ]
}
```

### 2) Video aktif
```http
GET /home-hero-videos/active
```
```json
{
  "success": true,
  "data": []
}
```

### 3) Detail video
```http
GET /home-hero-videos/1
```
```json
{
  "success": true,
  "data": {
    "id": 1,
    "title": "Digital School, Sekolahku Surgaku",
    "source_type": "url",
    "video_desktop": "https://cdn.example.com/video.mp4",
    "video_mobile": "https://cdn.example.com/video-mobile.mp4",
    "poster_image": null,
    "is_active": true,
    "order_index": 1
  }
}
``` 
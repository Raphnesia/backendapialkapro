# 📡 API Documentation - School Backend

## 🔗 **Base URL**
```
http://localhost:8000/api
```

---

## 👥 **Teacher Management APIs**

### **1. Get All Teachers**
```http
GET /api/teachers
```

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Adam Muttaqien, M.Si",
      "position": "Guru Matematika",
      "subject": "Matematika",
      "type": "teacher",
      "photo": "/teachers/adam-muttaqien.jpg",
      "bio": "Guru matematika dengan pengalaman 10 tahun...",
      "education": "S2 Matematika",
      "experience": "10 tahun mengajar matematika",
      "is_active": true,
      "order_index": 1,
      "created_at": "2024-01-15T10:30:00.000000Z",
      "updated_at": "2024-01-15T10:30:00.000000Z"
    }
  ]
}
```

**Query Parameters:**
- `type` (optional): Filter by type (`teacher`, `staff`, `principal`, `vice_principal`)
- `is_active` (optional): Filter by status (`1` for active, `0` for inactive)
- `sort` (optional): Sort by field (`name`, `order_index`, `created_at`)

**Example:**
```bash
GET /api/teachers?type=teacher&is_active=1&sort=order_index
```

---

### **2. Get Single Teacher**
```http
GET /api/teachers/{id}
```

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "name": "Adam Muttaqien, M.Si",
    "position": "Guru Matematika",
    "subject": "Matematika",
    "type": "teacher",
    "photo": "/teachers/adam-muttaqien.jpg",
    "bio": "Guru matematika dengan pengalaman 10 tahun...",
    "education": "S2 Matematika",
    "experience": "10 tahun mengajar matematika",
    "is_active": true,
    "order_index": 1,
    "guruData": {
      "title": "Guru & Staff",
      "subtitle": "Mengenal lebih dekat dengan para pengajar dan staf kami",
      "banner_desktop": "/guru-banners/banner-desktop.jpg",
      "banner_mobile": "/guru-banners/banner-mobile.jpg",
      "date": "Terbaru",
      "read_time": "3 min",
      "author": "Admin",
      "active": true
    }
  }
}
```

---

### **3. Teacher Page Settings**
```http
GET /api/teacher-settings
```

**Response:**
```json
{
  "success": true,
  "data": {
    "title": "Guru & Staff",
    "subtitle": "Mengenal lebih dekat dengan para pengajar dan staf kami",
    "banner_desktop": "/guru-banners/banner-desktop.jpg",
    "banner_mobile": "/guru-banners/banner-mobile.jpg",
    "date": "Terbaru",
    "read_time": "3 min",
    "author": "Admin"
  }
}
```

**Notes:**
- API ini mengambil pengaturan dari teacher yang memiliki `guruData->active = true`
- Jika tidak ada yang aktif, akan mengembalikan data default
- Banner URLs adalah relative paths yang perlu digabung dengan base URL

---

## 🏫 **School Profile APIs**

### **1. Get School Profile**
```http
GET /api/school-profile
```

**Response:**
```json
{
  "success": true,
  "data": {
    "name": "SMP Muhammadiyah Al Kautsar PK Kartasura",
    "address": "Jl. Raya Solo-Kartasura No. 123",
    "phone": "+62 271 123456",
    "email": "info@smpmuhammadiyah.sch.id",
    "website": "https://smpmuhammadiyah.sch.id",
    "vision": "Menjadi sekolah unggulan yang menghasilkan lulusan berkualitas...",
    "mission": "Menyelenggarakan pendidikan berkualitas...",
    "logo": "/school/logo.png",
    "banner": "/school/banner.jpg"
  }
}
```

---

## 📰 **News & Articles APIs**

### **1. Get All Posts**
```http
GET /api/posts
```

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "title": "Judul Berita",
      "slug": "judul-berita",
      "content": "Konten berita...",
      "excerpt": "Ringkasan berita...",
      "featured_image": "/posts/featured-image.jpg",
      "category": "news",
      "author": "Admin",
      "published_at": "2024-01-15T10:30:00.000000Z",
      "is_active": true
    }
  ],
  "meta": {
    "current_page": 1,
    "last_page": 5,
    "per_page": 10,
    "total": 50
  }
}
```

**Query Parameters:**
- `page` (optional): Page number for pagination
- `category` (optional): Filter by category
- `search` (optional): Search in title and content
- `is_active` (optional): Filter by status

---

## 🏆 **Achievements APIs**

### **1. Get All Achievements**
```http
GET /api/achievements
```

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "title": "Juara 1 Olimpiade Matematika",
      "description": "Siswa kami berhasil meraih juara 1...",
      "year": 2024,
      "level": "provincial",
      "image": "/achievements/olimpiade-math.jpg",
      "is_active": true,
      "order_index": 1
    }
  ]
}
```

---

## 🏢 **Facilities APIs**

### **1. Get All Facilities**
```http
GET /api/facilities
```

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Laboratorium Komputer",
      "description": "Lab komputer dengan 30 unit komputer...",
      "category": "laboratory",
      "capacity": 30,
      "location": "Gedung A Lantai 2",
      "image": "/facilities/lab-komputer.jpg",
      "is_active": true,
      "order_index": 1
    }
  ]
}
```

---

## 🎯 **Activities APIs**

### **1. Get All Activities**
```http
GET /api/activities
```

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "title": "Kegiatan Outbound",
      "description": "<p>Kegiatan outbound untuk siswa kelas 7...</p>",
      "category": "extracurricular",
      "activity_date": "2024-02-15",
      "activity_time": "08:00",
      "location": "Taman Wisata",
      "image": "/activities/outbound.jpg",
      "is_active": true,
      "order_index": 1
    }
  ]
}
```

### **2. Get Activities Settings**
```http
GET /api/v1/activities/settings
```

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "title": "Kegiatan Sekolah",
    "subtitle": "Dokumentasi kegiatan, prestasi, dan aktivitas siswa",
    "banner_desktop": "/storage/activities/banner-desktop.jpg",
    "banner_mobile": "/storage/activities/banner-mobile.jpg"
  }
}
```

### **3. Get Complete Activities**
```http
GET /api/v1/activities/complete
```

**Response:**
```json
{
  "success": true,
  "data": {
    "settings": {
      "id": 1,
      "title": "Kegiatan Sekolah",
      "subtitle": "Dokumentasi kegiatan, prestasi, dan aktivitas siswa",
      "banner_desktop": "/storage/activities/banner-desktop.jpg",
      "banner_mobile": "/storage/activities/banner-mobile.jpg"
    },
    "activities": [
      {
        "id": 1,
        "title": "Kegiatan Outbound",
        "description": "<p>Kegiatan outbound untuk siswa kelas 7...</p>",
        "category": "extracurricular",
        "activity_date": "2024-02-15",
        "activity_time": "08:00",
        "location": "Taman Wisata",
        "image": "/activities/outbound.jpg",
        "is_active": true,
        "order_index": 1
      }
    ]
  }
}
```

---

## 🔗 **Links APIs**

### **1. Get All Links**
```http
GET /api/links
```

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "title": "Facebook",
      "url": "https://facebook.com/smpmuhammadiyah",
      "category": "social",
      "target": "_blank",
      "icon": "facebook",
      "is_active": true,
      "order_index": 1
    }
  ]
}
```

---

## 🎨 **Frontend Implementation Examples**

### **1. React Hook untuk API Calls**
```javascript
// hooks/useApi.js
import { useState, useEffect } from 'react';

export const useApi = (endpoint) => {
  const [data, setData] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchData = async () => {
      try {
        setLoading(true);
        const response = await fetch(`/api/${endpoint}`);
        const result = await response.json();
        
        if (result.success) {
          setData(result.data);
        } else {
          setError('Failed to fetch data');
        }
      } catch (err) {
        setError(err.message);
      } finally {
        setLoading(false);
      }
    };

    fetchData();
  }, [endpoint]);

  return { data, loading, error };
};
```

### **2. Teacher Page Component**
```jsx
// components/TeacherPage.jsx
import React from 'react';
import { useApi } from '../hooks/useApi';

const TeacherPage = () => {
  const { data: teachers, loading: teachersLoading } = useApi('teachers');
  const { data: settings, loading: settingsLoading } = useApi('teacher-settings');

  if (teachersLoading || settingsLoading) {
    return <div>Loading...</div>;
  }

  return (
    <div>
      {/* Banner Section */}
      <div className="banner">
        <h1>{settings?.title}</h1>
        <p>{settings?.subtitle}</p>
        <img 
          src={settings?.banner_desktop} 
          alt="Banner"
          className="hidden md:block"
        />
        <img 
          src={settings?.banner_mobile} 
          alt="Banner"
          className="md:hidden"
        />
      </div>

      {/* Teachers List */}
      <div className="teachers-grid">
        {teachers?.map(teacher => (
          <div key={teacher.id} className="teacher-card">
            <img src={teacher.photo} alt={teacher.name} />
            <h3>{teacher.name}</h3>
            <p>{teacher.position}</p>
            <p>{teacher.subject}</p>
          </div>
        ))}
      </div>
    </div>
  );
};

export default TeacherPage;
```

### **3. Vue.js Composition API**
```vue
<!-- components/TeacherPage.vue -->
<template>
  <div>
    <!-- Banner Section -->
    <div class="banner" v-if="settings">
      <h1>{{ settings.title }}</h1>
      <p>{{ settings.subtitle }}</p>
      <img 
        :src="settings.banner_desktop" 
        alt="Banner"
        class="hidden md:block"
      />
      <img 
        :src="settings.banner_mobile" 
        alt="Banner"
        class="md:hidden"
      />
    </div>

    <!-- Teachers List -->
    <div class="teachers-grid">
      <div 
        v-for="teacher in teachers" 
        :key="teacher.id"
        class="teacher-card"
      >
        <img :src="teacher.photo" :alt="teacher.name" />
        <h3>{{ teacher.name }}</h3>
        <p>{{ teacher.position }}</p>
        <p>{{ teacher.subject }}</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const teachers = ref([]);
const settings = ref(null);
const loading = ref(true);

const fetchData = async () => {
  try {
    const [teachersRes, settingsRes] = await Promise.all([
      fetch('/api/teachers'),
      fetch('/api/teacher-settings')
    ]);
    
    const teachersData = await teachersRes.json();
    const settingsData = await settingsRes.json();
    
    if (teachersData.success) teachers.value = teachersData.data;
    if (settingsData.success) settings.value = settingsData.data;
  } catch (error) {
    console.error('Error fetching data:', error);
  } finally {
    loading.value = false;
  }
};

onMounted(fetchData);
</script>
```

---

## 🚨 **Error Handling**

### **Standard Error Response**
```json
{
  "success": false,
  "message": "Error message here",
  "errors": {
    "field": ["Error for specific field"]
  }
}
```

### **Common HTTP Status Codes**
- `200` - Success
- `400` - Bad Request
- `401` - Unauthorized
- `404` - Not Found
- `422` - Validation Error
- `500` - Server Error

---

## 🔧 **Environment Setup**

### **Development**
```bash
# Backend URL
VITE_API_BASE_URL=http://localhost:8000/api

# Frontend URL
VITE_FRONTEND_URL=http://localhost:3000
```

### **Production**
```bash
# Backend URL
VITE_API_BASE_URL=https://api.smpmuhammadiyah.sch.id/api

# Frontend URL
VITE_FRONTEND_URL=https://smpmuhammadiyah.sch.id
```

---

## 📋 **Testing Checklist**

- [ ] Test semua API endpoints
- [ ] Test error handling
- [ ] Test loading states
- [ ] Test responsive design
- [ ] Test data filtering dan sorting
- [ ] Test pagination (jika ada)
- [ ] Test image loading
- [ ] Test form validation
- [ ] Test CORS (Cross-Origin Resource Sharing)

---

**Last Updated:** $(date)
**Version:** 2.0
**Status:** ✅ Production Ready 
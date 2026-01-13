# 🚀 Frontend Quick Reference - School Backend

## 📋 **Quick Overview**

**Backend URL:** `http://localhost:8000/api`  
**Admin Panel:** `http://localhost:8000/admin`  
**Status:** ✅ Production Ready

---

## 🎯 **Key Changes (Latest Update)**

### **Navigation Structure Updated**
```
📚 Guru & Staff (Navigation Group)
├── 👥 Daftar Guru & Staff (TeacherResource)
└── ⚙️ Pengaturan Halaman (TeacherSettings)
```

**"Pengaturan Halaman Guru" sekarang menjadi sub-menu dari "Guru & Staff"**

---

## 🔗 **Essential APIs**

### **Teacher Management**
```bash
GET /api/teachers                    # Daftar semua guru
GET /api/teachers/{id}              # Detail guru tertentu
GET /api/teacher-settings           # Pengaturan halaman guru
```

### **School Content**
```bash
GET /api/posts                      # Berita & artikel
GET /api/achievements               # Prestasi sekolah
GET /api/facilities                 # Fasilitas sekolah
GET /api/activities                 # Kegiatan sekolah
GET /api/links                      # Link sosial media
GET /api/school-profile             # Profil sekolah
```

---

## 💻 **Quick Implementation**

### **React Example**
```jsx
// Fetch teachers and settings
const { data: teachers } = useApi('teachers');
const { data: settings } = useApi('teacher-settings');

// Use in component
<div>
  <h1>{settings?.title}</h1>
  <p>{settings?.subtitle}</p>
  {teachers?.map(teacher => (
    <div key={teacher.id}>
      <img src={teacher.photo} alt={teacher.name} />
      <h3>{teacher.name}</h3>
    </div>
  ))}
</div>
```

### **Vue Example**
```vue
<template>
  <div>
    <h1>{{ settings?.title }}</h1>
    <div v-for="teacher in teachers" :key="teacher.id">
      <img :src="teacher.photo" :alt="teacher.name" />
      <h3>{{ teacher.name }}</h3>
    </div>
  </div>
</template>
```

---

## 📁 **Documentation Files**

- 📖 **`TEACHER_NAVIGATION_UPDATE.md`** - Detail perubahan navigasi
- 📡 **`API_DOCUMENTATION.md`** - Dokumentasi API lengkap
- 🔧 **`GURU_DATA_SETUP.md`** - Setup guru data system

---

## 🚨 **Important Notes**

1. **API Response Format:**
   ```json
   {
     "success": true,
     "data": [...]
   }
   ```

2. **Image URLs:** Relative paths, perlu digabung dengan base URL

3. **Error Handling:** Always check `success` field in response

4. **Loading States:** Implement loading indicators for better UX

---

## 🔧 **Environment Variables**

```bash
# Development
VITE_API_BASE_URL=http://localhost:8000/api

# Production  
VITE_API_BASE_URL=https://api.smpmuhammadiyah.sch.id/api
```

---

## 📞 **Support**

- **Backend Issues:** Check Laravel logs
- **API Issues:** Test with Postman/curl
- **Documentation:** See detailed docs above

---

**Last Updated:** $(date)  
**Version:** 2.0 
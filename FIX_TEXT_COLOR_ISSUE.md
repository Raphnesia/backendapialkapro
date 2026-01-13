# 🎨 FIX: WARNA TEKS ABU-ABU PADA VISI MISI

## 🚨 **Masalah:**
Warna teks di konten Visi Misi menjadi abu-abu, seharusnya hitam.

## 🔍 **Penyebab:**
Class `prose` dari Tailwind CSS Typography plugin mempengaruhi warna teks menjadi abu-abu.

## ✅ **Solusi:**

### **1. Gunakan `prose-black`**
```jsx
// SEBELUM (Teks Abu-abu)
<div className="prose max-w-none">

// SESUDAH (Teks Hitam)
<div className="prose prose-black max-w-none">
```

### **2. Tambahkan Class `text-black`**
```jsx
<div className="text-black" dangerouslySetInnerHTML={{ __html: section.content }} />

<ul className="list-disc pl-5 space-y-2 text-black">
  {section.list_items.map((item, idx) => (
    <li key={idx} className="text-black">{item.item}</li>
  ))}
</ul>
```

### **3. Override Prose Styles**
```css
/* Tambahkan CSS custom */
.prose {
  color: #000000 !important;
}

.prose p {
  color: #000000 !important;
}

.prose li {
  color: #000000 !important;
}
```

---

## 🔧 **Frontend Implementation yang Diperbaiki:**

### **React/Next.js - Visi Misi:**
```jsx
import { useState, useEffect } from 'react';

function VisiMisiPage() {
  const [data, setData] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetch('http://localhost:8000/api/v1/visi-misi/complete')
      .then(response => response.json())
      .then(result => {
        if (result.success) {
          setData(result.data);
        }
        setLoading(false);
      });
  }, []);

  if (loading) return <div>Loading...</div>;
  if (!data) return <div>No data</div>;

  return (
    <div className="min-h-screen flex flex-col">
      {/* Banner Section */}
      <div className="relative w-full md:h-screen h-64">
        {/* Desktop Banner */}
        <img 
          src={data.settings.banner_desktop} 
          alt="banner"
          className="object-cover hidden md:block w-full h-full"
        />
        
        {/* Mobile Banner */}
        <img 
          src={data.settings.banner_mobile} 
          alt="banner"
          className="object-cover md:hidden w-full h-full"
        />
        
        {/* Overlay Content untuk Desktop */}
        <div className="absolute inset-0 hidden md:flex md:items-end">
          <div className="w-full bg-gradient-to-t from-green-900/80 via-green-800/40 to-transparent">
            <div className="container mx-auto px-8 pb-16">
              <div className="max-w-3xl">
                {/* Title Panel */}
                <div className="block">
                  <div className={`${data.settings.title_panel_bg_color} inline-flex p-5`}>
                    <h1 className="text-2xl md:text-3xl lg:text-2xl font-bold text-white mb-0">
                      {data.settings.title}
                    </h1>
                  </div>
                </div>
                
                {/* Subtitle Panel */}
                <div className={`${data.settings.subtitle_panel_bg_color} p-4 opacity-90 inline-flex rounded-b-lg`}>
                  <p className="text-white text-sm md:text-lg font-semibold mb-0">
                    {data.settings.subtitle}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      {/* Mobile Title Panel */}
      <div className="w-full bg-gradient-to-r from-green-600 to-green-900 py-4 md:hidden">
        <div className="container mx-auto px-4">
          <div className="block">
            <div className={`${data.settings.mobile_panel_bg_color} inline-flex p-3`}>
              <h1 className="text-lg font-bold text-white mb-0">
                {data.settings.title}
              </h1>
            </div>
          </div>
        </div>
      </div>

      {/* Content Sections */}
      <main className="flex-grow container mx-auto px-4 py-8 bg-white">
        <div className="prose prose-black max-w-none">
          {data.content.map((section, index) => (
            <div key={index} className={`${section.background_color} ${section.border_color} rounded-lg shadow-md p-6 mb-8`}>
              <div className="flex items-center justify-center mb-6">
                <div className="w-16 h-1 bg-primary rounded-full mr-3"></div>
                <h2 className="text-2xl font-semibold text-primary">{section.title}</h2>
                <div className="w-16 h-1 bg-primary rounded-full ml-3"></div>
              </div>
              
              <div className={`grid ${section.grid_type} gap-6`}>
                {/* ✅ TAMBAHKAN text-black DI SINI */}
                <div className="text-black" dangerouslySetInnerHTML={{ __html: section.content }} />
                
                {section.use_list_disc && section.list_items && (
                  <ul className="list-disc pl-5 space-y-2 text-black">
                    {section.list_items.map((item, idx) => (
                      <li key={idx} className="text-black">{item.item}</li>
                    ))}
                  </ul>
                )}
              </div>
            </div>
          ))}
        </div>
      </main>
    </div>
  );
}

export default VisiMisiPage;
```

---

## 🎨 **Solusi CSS Custom:**

### **1. Tambahkan CSS Global:**
```css
/* styles/globals.css atau file CSS Anda */
.prose {
  color: #000000 !important;
}

.prose p {
  color: #000000 !important;
}

.prose li {
  color: #000000 !important;
}

.prose h1,
.prose h2,
.prose h3,
.prose h4,
.prose h5,
.prose h6 {
  color: #000000 !important;
}

.prose strong {
  color: #000000 !important;
}

.prose em {
  color: #000000 !important;
}
```

### **2. Tailwind Config:**
```javascript
// tailwind.config.js
module.exports = {
  theme: {
    extend: {
      typography: {
        DEFAULT: {
          css: {
            color: '#000000',
            p: {
              color: '#000000',
            },
            li: {
              color: '#000000',
            },
            h1: {
              color: '#000000',
            },
            h2: {
              color: '#000000',
            },
            h3: {
              color: '#000000',
            },
            h4: {
              color: '#000000',
            },
            h5: {
              color: '#000000',
            },
            h6: {
              color: '#000000',
            },
          },
        },
      },
    },
  },
  plugins: [require('@tailwindcss/typography')],
}
```

---

## 🔧 **Alternatif Solusi:**

### **1. Tanpa Prose Class:**
```jsx
{/* Ganti prose dengan styling manual */}
<div className="max-w-none">
  {data.content.map((section, index) => (
    <div key={index} className={`${section.background_color} ${section.border_color} rounded-lg shadow-md p-6 mb-8`}>
      <div className="flex items-center justify-center mb-6">
        <div className="w-16 h-1 bg-primary rounded-full mr-3"></div>
        <h2 className="text-2xl font-semibold text-primary">{section.title}</h2>
        <div className="w-16 h-1 bg-primary rounded-full ml-3"></div>
      </div>
      
      <div className={`grid ${section.grid_type} gap-6`}>
        <div className="text-black prose prose-black max-w-none" dangerouslySetInnerHTML={{ __html: section.content }} />
        
        {section.use_list_disc && section.list_items && (
          <ul className="list-disc pl-5 space-y-2 text-black">
            {section.list_items.map((item, idx) => (
              <li key={idx} className="text-black">{item.item}</li>
            ))}
          </ul>
        )}
      </div>
    </div>
  ))}
</div>
```

### **2. Inline Styles:**
```jsx
<div 
  className="text-black" 
  style={{ color: '#000000' }}
  dangerouslySetInnerHTML={{ __html: section.content }} 
/>
```

---

## 📝 **Notes:**

1. **Prose Class**: Class `prose` dari Tailwind Typography plugin memberikan styling default yang bisa mempengaruhi warna teks
2. **Prose Variants**: Gunakan `prose-black`, `prose-gray`, `prose-slate` untuk mengontrol warna
3. **Important Declaration**: Gunakan `!important` untuk override styling default
4. **Specificity**: Pastikan CSS custom memiliki specificity yang cukup tinggi

---

## 🚀 **Quick Fix:**

**Paling Cepat:**
```jsx
// Ganti ini:
<div className="prose max-w-none">

// Menjadi ini:
<div className="prose prose-black max-w-none">
```

**Dan tambahkan:**
```jsx
<div className="text-black" dangerouslySetInnerHTML={{ __html: section.content }} />
```

---

**Sekarang teks di Visi Misi akan berwarna hitam!** 🎨 
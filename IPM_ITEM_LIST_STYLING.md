# 🕌 IPM ITEM LIST STYLING - DIV FORMAT

## 🎯 **Konsep:**
Item list di IPM ditampilkan sebagai **div cards**, bukan sebagai list bullet points.

## 🎨 **Styling yang Diinginkan:**

### **Struktur Organisasi IPM**
```
┌─────────────────────────────────────┐
│ Struktur Organisasi IPM             │
├─────────────────────────────────────┤
│ ┌─────────────────────────────────┐ │
│ │ Ketua IPM                      │ │
│ │ Ahmad Fauzan                   │ │
│ └─────────────────────────────────┘ │
│ ┌─────────────────────────────────┐ │
│ │ Wakil Ketua                    │ │
│ │ Zahra Aulia                    │ │
│ └─────────────────────────────────┘ │
│ ┌─────────────────────────────────┐ │
│ │ Sekretaris                     │ │
│ │ Nabila Putri                   │ │
│ └─────────────────────────────────┘ │
└─────────────────────────────────────┘
```

---

## 🔧 **Frontend Implementation:**

### **React/Next.js - IPM Page:**
```jsx
import { useState, useEffect } from 'react';

function IPMPage() {
  const [data, setData] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetch('http://localhost:8000/api/v1/ipm/complete')
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
      <div className="relative h-[70vh] mx-auto flex items-center justify-center overflow-hidden">
        <div 
          className="absolute inset-0 bg-cover bg-center z-0"
          style={{
            backgroundImage: `url('${data.settings.banner_desktop}')`
          }}
        >
          <div className="absolute inset-0 bg-gradient-to-r from-red-900/80 via-red-800/60 to-transparent"></div>
        </div>
        <div className="relative z-10 text-center px-4">
          <div className="max-w-4xl mx-auto">
            <h1 className="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight">
              {data.settings.title}
              <span className="block text-yellow-400">Sekolah Kami</span>
            </h1>
            <p className="text-lg md:text-xl text-gray-200 max-w-2xl mx-auto">
              {data.settings.subtitle}
            </p>
          </div>
        </div>
      </div>

      {/* IPM Content */}
      <main className="flex-grow container mx-auto px-4 py-8 bg-white">
        <h1 className="text-3xl font-bold text-primary mb-6">Ikatan Pelajar Muhammadiyah (IPM)</h1>
        
        <div className="prose prose-black max-w-none">
          {/* Pengenalan IPM */}
          <div className="bg-white rounded-lg shadow-md p-6 mb-8">
            <h2 className="text-2xl font-semibold text-black mb-4">Tentang IPM</h2>
            
            <div className="flex flex-col md:flex-row gap-6">
              <div className="md:w-2/3">
                <p className="mb-4 text-black">
                  Ikatan Pelajar Muhammadiyah (IPM) adalah organisasi otonom Muhammadiyah yang bergerak di kalangan pelajar. 
                  Di SMP Muhammadiyah Al Kautsar PK Kartasura, IPM menjadi wadah bagi siswa untuk mengembangkan jiwa 
                  kepemimpinan, kreativitas, dan aktivitas sosial keagamaan sesuai dengan nilai-nilai Islam dan 
                  Kemuhammadiyahan.
                </p>
                
                <div className="bg-blue-50 p-4 rounded-lg mb-4">
                  <h3 className="text-lg font-semibold text-black mb-2">Visi IPM</h3>
                  <p className="italic text-black">
                    "Terwujudnya pelajar muslim yang berilmu, berakhlak mulia, dan terampil dalam rangka menegakkan 
                    dan menjunjung tinggi nilai-nilai Islam sehingga terwujud masyarakat Islam yang sebenar-benarnya."
                  </p>
                </div>
              </div>
              
              <div className="md:w-1/3">
                <div className="bg-primary rounded-lg overflow-hidden">
                  <div className="p-4 bg-gradient-to-r from-red-600 to-red-800 text-white text-center">
                    <h3 className="font-bold text-lg text-white">Struktur Organisasi IPM</h3>
                  </div>
                  <div className="p-4 bg-white text-black">
                    {/* ✅ ITEM LIST SEBAGAI DIV CARDS */}
                    <div className="space-y-2">
                      {data.pengurus.map((pengurus, index) => (
                        <div key={index} className="flex justify-between items-center border-b pb-2">
                          <span className="font-medium text-sm">{pengurus.position}</span>
                          <span className="text-xs text-gray-600">{pengurus.name}</span>
                        </div>
                      ))}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          {/* IPM Content Sections */}
          {data.content.map((section, index) => (
            <section key={index} className="relative lg:h-[400px] h-auto mb-8">
              <img 
                draggable={false} 
                alt="banner" 
                src="https://www.ums.ac.id/__image__/uploads/KZ4tligbcEdhZFxCLan8FNQMirVQuIYtCOMHLOqd.svg" 
                className="w-full absolute inset-0 object-cover h-full" 
              />
              
              <div className="relative lg:absolute top-0 w-full h-full flex">
                <div className="w-full lg:relative mt-auto">
                  <div className="flex justify-center mx-0 mt-3 lg:mt-5 px-4">
                    {/* Mobile Layout */}
                    <div className="w-full lg:hidden flex flex-col items-center text-center py-6">
                      <div className="mb-6">
                        <img 
                          draggable={false} 
                          alt={`${section.title} image`} 
                          src={section.photo} 
                          className="rounded-full bg-gray-300 mx-auto" 
                          style={{width: '35vw', height: '35vw', objectFit: 'cover'}} 
                        />
                      </div>
                      
                      <div className="px-4 text-left">
                        <h4 className="text-sm mb-2 text-black">{section.title}</h4>
                        <h3 className="mb-2 font-bold text-black" style={{fontSize: '28px'}}>{section.name}</h3>
                        <div className="flex mb-3">
                          <span className="w-16 h-1 bg-green-600"></span>
                        </div>
                        <p className="font-semibold text-sm font-regular mb-4 text-black">
                          {section.description}
                        </p>
                        <p className="text-sm text-gray-600">Kelas: {section.kelas}</p>
                      </div>
                    </div>
                    
                    {/* Desktop Layout */}
                    <div className="hidden lg:flex w-full max-w-6xl mx-auto">
                      {index % 2 === 0 ? (
                        // Foto di kiri, teks di kanan
                        <>
                          <div className="w-5/12 flex items-end justify-center relative z-20">
                            <img 
                              draggable={false} 
                              alt={`${section.title} image`} 
                              src={section.photo}
                              className="max-w-xs h-auto object-cover" 
                              style={{maxHeight: '300px', width: 'auto'}} 
                            />
                          </div>
                          <div className="w-7/12 pt-3 text-left lg:text-right flex items-center relative z-10" style={{marginBottom: '6rem'}}>
                            <div>
                              <h4 className="text-lg font-medium text-black mb-2">{section.title}</h4>
                              <h3 className="mb-1 text-2xl lg:text-3xl font-bold text-black">{section.name}</h3>
                              <div className="flex justify-start mb-3">
                                <span className="w-16 h-1 bg-green-600 mb-3"></span>
                              </div>
                              <p className="font-bold text-lg font-semibold text-black mb-4">{section.description}</p>
                              <p className="text-sm text-gray-600">Kelas: {section.kelas}</p>
                            </div>
                          </div>
                        </>
                      ) : (
                        // Teks di kiri, foto di kanan
                        <>
                          <div className="w-7/12 pt-3 text-left flex items-center relative z-10" style={{marginBottom: '6rem'}}>
                            <div>
                              <h4 className="text-lg font-medium text-black mb-2">{section.title}</h4>
                              <h3 className="mb-1 text-2xl lg:text-3xl font-bold text-black">{section.name}</h3>
                              <div className="flex justify-start mb-3">
                                <span className="w-16 h-1 bg-green-600 mb-3"></span>
                              </div>
                              <p className="font-bold text-lg font-semibold text-black mb-4">{section.description}</p>
                              <p className="text-sm text-gray-600">Kelas: {section.kelas}</p>
                            </div>
                          </div>
                          <div className="w-5/12 flex items-end justify-center relative z-20">
                            <img 
                              draggable={false} 
                              alt={`${section.title} image`} 
                              src={section.photo}
                              className="max-w-xs h-auto object-cover" 
                              style={{maxHeight: '300px', width: 'auto'}} 
                            />
                          </div>
                        </>
                      )}
                    </div>
                  </div>
                  
                  {/* Footer */}
                  <div className="w-full h-12 bg-gradient-to-r from-red-600 to-red-800 flex justify-center absolute bottom-0 mx-0 z-0">
                    <div className="hidden lg:block lg:w-5/12"></div>
                    <div className="w-full lg:w-7/12 text-sm font-bold text-white py-3 text-right flex items-center justify-end pr-4">
                      {/* Footer content dapat ditambahkan di sini */}
                    </div>
                  </div>
                </div>
              </div>
            </section>
          ))}
        </div>
      </main>
    </div>
  );
}

export default IPMPage;
```

---

## 🎨 **Styling untuk Item List sebagai Div:**

### **1. Basic Div Cards:**
```jsx
{section.use_list_disc && section.list_items && (
  <div className="space-y-3">
    {section.list_items.map((item, idx) => (
      <div key={idx} className="bg-white p-3 rounded-lg border border-gray-200 shadow-sm">
        <p className="text-black font-medium">{item.item}</p>
      </div>
    ))}
  </div>
)}
```

### **2. Enhanced Div Cards:**
```jsx
{section.use_list_disc && section.list_items && (
  <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
    {section.list_items.map((item, idx) => (
      <div key={idx} className="bg-white p-4 rounded-lg border border-gray-200 shadow-md hover:shadow-lg transition-shadow">
        <div className="flex items-center">
          <div className="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center mr-3">
            <span className="text-red-600 font-bold text-sm">{idx + 1}</span>
          </div>
          <p className="text-black font-medium">{item.item}</p>
        </div>
      </div>
    ))}
  </div>
)}
```

### **3. Table-like Div Layout:**
```jsx
{section.use_list_disc && section.list_items && (
  <div className="bg-white rounded-lg border border-gray-200 overflow-hidden">
    <div className="bg-gray-50 px-4 py-3 border-b border-gray-200">
      <h4 className="font-semibold text-gray-800">Struktur Organisasi IPM</h4>
    </div>
    <div className="divide-y divide-gray-200">
      {section.list_items.map((item, idx) => (
        <div key={idx} className="px-4 py-3 hover:bg-gray-50 transition-colors">
          <div className="flex justify-between items-center">
            <span className="font-medium text-gray-800">{item.item}</span>
            <span className="text-sm text-gray-600">{item.name || ''}</span>
          </div>
        </div>
      ))}
    </div>
  </div>
)}
```

---

## 📝 **Contoh Data Item List:**

### **Struktur Organisasi IPM:**
```json
{
  "list_items": [
    {"item": "Ketua IPM", "name": "Ahmad Fauzan"},
    {"item": "Wakil Ketua", "name": "Zahra Aulia"},
    {"item": "Sekretaris", "name": "Nabila Putri"},
    {"item": "Bendahara", "name": "Rizki Pratama"},
    {"item": "Sie. Keagamaan", "name": "Fatimah Azzahra"},
    {"item": "Sie. Kesiswaan", "name": "Muhammad Rizki"}
  ]
}
```

### **Program Kerja IPM:**
```json
{
  "list_items": [
    {"item": "Kajian Rutin Mingguan"},
    {"item": "Tahfidz Al-Qur'an"},
    {"item": "Bakti Sosial"},
    {"item": "Pelatihan Kepemimpinan"},
    {"item": "Kegiatan Ramadhan"},
    {"item": "Study Tour Keagamaan"}
  ]
}
```

---

## 🎯 **Keuntungan Div Format:**

1. **Flexible Layout**: Bisa diatur dengan grid, flexbox, atau layout custom
2. **Better Styling**: Lebih mudah untuk styling dengan shadow, border, hover effects
3. **Responsive Design**: Lebih mudah untuk responsive design
4. **Interactive Elements**: Bisa ditambahkan hover, click events, dll
5. **Custom Content**: Bisa menambahkan icon, badge, atau elemen lain

---

**Sekarang item list di IPM akan ditampilkan sebagai div cards yang lebih menarik!** 🎨 
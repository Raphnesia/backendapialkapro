# Panduan Integrasi Frontend - Sistem Pimpinan SMP

## Overview
Panduan ini menjelaskan cara mengintegrasikan API Pimpinan SMP ke dalam frontend React/Next.js.

## Setup Awal

### 1. Environment Variables
Tambahkan base URL API ke file `.env.local`:
```env
NEXT_PUBLIC_API_BASE_URL=http://localhost:8000/api/v1
```

### 2. API Service
Buat file `lib/api.js` untuk mengelola API calls:

```javascript
const API_BASE_URL = process.env.NEXT_PUBLIC_API_BASE_URL || 'http://localhost:8000/api/v1';

export const pimpinanSMPApi = {
  // Get complete data (recommended for initial load)
  getCompleteData: async () => {
    try {
      const response = await fetch(`${API_BASE_URL}/pimpinan-smp/complete`);
      const data = await response.json();
      return data.success ? data.data : null;
    } catch (error) {
      console.error('Error fetching complete data:', error);
      return null;
    }
  },

  // Get settings only
  getSettings: async () => {
    try {
      const response = await fetch(`${API_BASE_URL}/pimpinan-smp/settings`);
      const data = await response.json();
      return data.success ? data.data : null;
    } catch (error) {
      console.error('Error fetching settings:', error);
      return null;
    }
  },

  // Get all pimpinan
  getAllPimpinan: async () => {
    try {
      const response = await fetch(`${API_BASE_URL}/pimpinan-smp`);
      const data = await response.json();
      return data.success ? data.data : [];
    } catch (error) {
      console.error('Error fetching pimpinan:', error);
      return [];
    }
  },

  // Get pimpinan by type
  getPimpinanByType: async (type) => {
    try {
      const response = await fetch(`${API_BASE_URL}/pimpinan-smp/type/${type}`);
      const data = await response.json();
      return data.success ? data.data : [];
    } catch (error) {
      console.error('Error fetching pimpinan by type:', error);
      return [];
    }
  },

  // Get kepala sekolah
  getKepalaSekolah: async () => {
    try {
      const response = await fetch(`${API_BASE_URL}/pimpinan-smp/kepala-sekolah`);
      const data = await response.json();
      return data.success ? data.data[0] : null;
    } catch (error) {
      console.error('Error fetching kepala sekolah:', error);
      return null;
    }
  },

  // Get wakil kepala sekolah
  getWakilKepalaSekolah: async () => {
    try {
      const response = await fetch(`${API_BASE_URL}/pimpinan-smp/wakil-kepala-sekolah`);
      const data = await response.json();
      return data.success ? data.data : [];
    } catch (error) {
      console.error('Error fetching wakil kepala sekolah:', error);
      return [];
    }
  },

  // Get boxes
  getBoxes: async () => {
    try {
      const response = await fetch(`${API_BASE_URL}/pimpinan-smp/boxes`);
      const data = await response.json();
      return data.success ? data.data : [];
    } catch (error) {
      console.error('Error fetching boxes:', error);
      return [];
    }
  },
};
```

## Component Implementation

### 1. Main Pimpinan SMP Page Component

```tsx
'use client'

import React, { useState, useEffect } from 'react'
import { Header } from '@/components/Header'
import Image from 'next/image'
import { pimpinanSMPApi } from '@/lib/api'

interface PimpinanSMPDetailProps {
  searchParams: { id?: string }
}

const PimpinanSMPDetail = ({ searchParams }: PimpinanSMPDetailProps) => {
  const [data, setData] = useState<any>(null)
  const [loading, setLoading] = useState(true)

  useEffect(() => {
    const fetchData = async () => {
      setLoading(true)
      const completeData = await pimpinanSMPApi.getCompleteData()
      setData(completeData)
      setLoading(false)
    }

    fetchData()
  }, [])

  if (loading) {
    return (
      <div className="min-h-screen bg-gray-50 flex flex-col">
        <Header />
        <div className="flex-1 flex items-center justify-center">
          <div className="text-center">
            <div className="animate-spin rounded-full h-32 w-32 border-b-2 border-green-600 mx-auto"></div>
            <p className="mt-4 text-gray-600">Memuat data pimpinan SMP...</p>
          </div>
        </div>
      </div>
    )
  }

  if (!data) {
    return (
      <div className="min-h-screen bg-gray-50 flex flex-col">
        <Header />
        <div className="flex-1 flex items-center justify-center">
          <div className="text-center">
            <p className="text-red-600">Gagal memuat data pimpinan SMP</p>
          </div>
        </div>
      </div>
    )
  }

  const { settings, pimpinan, boxes } = data

  // Get kepala sekolah (first in array)
  const kepalaSekolah = pimpinan.find((p: any) => p.type === 'kepala_sekolah')
  
  // Get wakil kepala sekolah (sorted by order_index)
  const wakilKepalaSekolah = pimpinan
    .filter((p: any) => p.type !== 'kepala_sekolah')
    .sort((a: any, b: any) => a.order_index - b.order_index)

  const ShareButton = ({ icon, bg, size = 'normal' }: { icon: string; bg: string; size?: 'normal' | 'small' }) => (
    <button className={`${bg} text-white ${size === 'small' ? 'w-8 h-8 text-xs' : 'w-10 h-10 text-sm'} rounded-full flex items-center justify-center hover:opacity-80 transition-opacity`}>
      {icon}
    </button>
  )

  return (
    <div className="min-h-screen bg-gray-50 flex flex-col">
      {/* Header */}
      <Header />
      
      {/* Main Content */}
      <main className="pt-0 flex-1">
        {/* Banner Section */}
        <div className="relative w-full md:h-screen h-64">
          {/* Desktop Image */}
          <Image 
            src={settings?.banner_desktop || '/default-banner.jpg'}
            alt="banner"
            fill
            className="object-cover hidden md:block"
            priority
            sizes="100vw"
            quality={75}
          />
          {/* Mobile Image */}
          <div className="relative w-full h-full md:hidden">
            <Image 
              src={settings?.banner_mobile || '/default-banner-mobile.jpg'}
              alt="banner"
              fill
              className="object-cover"
              priority
              sizes="100vw"
              quality={75}
            />
          </div>
          
          {/* Overlay Content untuk Desktop */}
          <div className="absolute inset-0 hidden md:flex md:items-end">
            <div className="w-full bg-gradient-to-t from-black/80 via-black/40 to-transparent">
              <div className="container mx-auto px-8 pb-16">
                <div className="max-w-3xl">
                  {/* Title Panel */}
                  <div className="d-block">
                    <div className="bg-green-500 d-inline-flex p-5 title-panel-scoped" style={{boxSizing: 'border-box'}}>
                      <h1 className="text-2xl md:text-3xl lg:text-2xl font-bold text-white mb-0 line-clamp-2" style={{padding: '0px !important'}}>
                        {settings?.title || 'Pimpinan SMP'}
                      </h1>
                    </div>
                  </div>
                  
                  {/* Subtitle Panel */}
                  <div className="bg-green-700 p-4 opacity-90 d-inline-flex rounded-b-lg" style={{boxSizing: 'border-box'}}>
                    <p className="text-white text-sm md:text-lg font-semibold mb-0">
                      {settings?.subtitle || 'Kepemimpinan yang visioner dan berpengalaman'}
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        {/* Mobile Title Section */}
        <div className="w-full bg-gradient-to-r from-green-600 to-green-900 py-4 md:hidden">
          <div className="container mx-auto px-4">
            <div className="d-block">
              {/* Title Panel untuk Mobile */}
              <div className="bg-green-700 d-inline-flex p-3 title-panel-scoped">
                <h1 className="text-lg font-bold text-white mb-0" style={{padding: '0px !important'}}>
                  {settings?.title || 'Pimpinan SMP'}
                </h1>
              </div>
              
              {/* Subtitle Panel untuk Mobile */}
              <div className="bg-green-800 mb-0 p-3 opacity-90 d-inline-flex subtitle-panel-scoped">
                <div>
                  <p className="text-white text-xs font-semibold mb-0">
                    {settings?.subtitle || 'Kepemimpinan yang visioner dan berpengalaman'}
                  </p>
                </div>
              </div>
            </div>
            
            {/* Meta Info untuk Mobile */}
            <div className="flex flex-wrap items-center gap-2 text-white/80 mt-3 text-xs">
              <div className="flex items-center gap-2">
                <div className="relative w-6 h-6">
                  <Image 
                    src="/pace.jpeg"
                    alt="Author"
                    fill
                    className="rounded-full object-cover"
                    sizes="24px"
                  />
                </div>
                <span>Tim Humas SMP</span>
              </div>
              <span>•</span>
              <span>{new Date().toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' })}</span>
            </div>
            
            {/* Share buttons untuk Mobile */}
            <div className="flex items-center gap-2 mt-3">
              <ShareButton icon="𝕏" bg="bg-black" size="small" />
              <ShareButton icon="f" bg="bg-[#1877F2]" size="small" />
              <ShareButton icon="in" bg="bg-[#0077B5]" size="small" />
              <ShareButton icon="🔗" bg="bg-gray-600" size="small" />
            </div>
          </div>
        </div>

        {/* Pimpinan Sections */}
        {kepalaSekolah && (
          <PimpinanSection 
            pimpinan={kepalaSekolah}
            layout="left"
            isKepalaSekolah={true}
          />
        )}

        {wakilKepalaSekolah.map((pimpinan: any, index: number) => (
          <PimpinanSection 
            key={pimpinan.id}
            pimpinan={pimpinan}
            layout={index % 2 === 0 ? "right" : "left"}
            isKepalaSekolah={false}
          />
        ))}

        {/* Keunggulan Kepemimpinan Section */}
        <section className="bg-white py-16">
          <div className="container mx-auto px-4 md:px-8">
            <div className="text-center mb-12">
              <h2 className="text-3xl md:text-4xl font-bold text-green-600 mb-4">
                {settings?.keunggulan_title || 'Keunggulan Kepemimpinan'}
              </h2>
              <p className="text-gray-600 max-w-2xl mx-auto">
                {settings?.keunggulan_subtitle || 'Tim pimpinan yang handal dan berpengalaman'}
              </p>
            </div>
            
            {/* Boxes Grid */}
            <div className="flex flex-wrap bg-green-600">
              {boxes.map((box: any, index: number) => (
                <React.Fragment key={box.id}>
                  {/* Text Box */}
                  <div className={`w-1/2 lg:w-1/3 order-${index * 2 + 1} lg:order-${index + 1} p-1 sm:p-2 md:p-3 lg:p-4 text-center text-white flex items-center ${box.background_color === 'green-700' ? 'bg-green-700' : ''}`}>
                    <div className="w-full py-2 sm:py-2 md:py-3 lg:py-4 px-1 sm:px-2 md:px-3 lg:px-3 text-white">
                      <div className="w-12 h-12 mx-auto mb-2 bg-white rounded-full flex items-center justify-center">
                        <span className="text-green-600 text-2xl font-bold">{box.icon}</span>
                      </div>
                      <span className="text-xl font-bold block">
                        {box.title}
                      </span>
                      <p className="mt-2 md:mt-3 text-sm font-semibold">{box.description}</p>
                    </div>
                  </div>
                  
                  {/* Image Box */}
                  <div 
                    className={`w-1/2 lg:w-1/3 order-${index * 2 + 2} lg:order-${index + 1} h-64`}
                    style={{
                      background: box.image ? `url('${box.image}') center center / cover` : 'url("/default-image.jpg") center center / cover'
                    }}
                  ></div>
                </React.Fragment>
              ))}
            </div>
          </div>
        </section>
      </main>
    </div>
  )
}

// Pimpinan Section Component
const PimpinanSection = ({ pimpinan, layout, isKepalaSekolah }: { 
  pimpinan: any, 
  layout: 'left' | 'right', 
  isKepalaSekolah: boolean 
}) => {
  const getTypeLabel = (type: string) => {
    const labels: { [key: string]: string } = {
      'kepala_sekolah': 'Kepala Sekolah',
      'wakil_kepala_sekolah_kurikulum': 'Wakil Kepala Sekolah Kurikulum',
      'wakil_kepala_sekolah_kesiswaan': 'Wakil Kepala Sekolah Kesiswaan',
      'wakil_kepala_sekolah_sdm_humas': 'Wakil Kepala Sekolah SDM & Humas',
      'wakil_kepala_sekolah_aik': 'Wakil Kepala Sekolah AIK',
      'wakil_kepala_sekolah_sarpras': 'Wakil Kepala Sekolah Sarana Prasarana',
    }
    return labels[type] || type
  }

  return (
    <section className="relative lg:h-[554px] h-auto" style={{fontFamily: 'Ubuntu, sans-serif'}}>
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
            <div className="w-full lg:hidden flex flex-col items-center text-center py-6" style={{fontFamily: 'Ubuntu, sans-serif'}}>
              {/* Mobile Image */}
              <div className="mb-6">
                <img 
                  draggable={false} 
                  alt={`${pimpinan.name} image`}
                  src={pimpinan.photo || '/default-avatar.jpg'}
                  className="rounded-full bg-gray-300 mx-auto" 
                  style={{width: '35vw', height: '35vw', objectFit: 'cover'}} 
                />
              </div>
              
              {/* Mobile Content */}
              <div className="px-4 text-left">
                <h4 className="text-sm mb-2 text-black" style={{fontFamily: 'Ubuntu, sans-serif'}}>
                  {getTypeLabel(pimpinan.type)}
                </h4>
                
                <h3 className="mb-2 font-bold text-black" style={{fontFamily: 'Ubuntu, sans-serif', fontSize: '28px'}}>
                  {pimpinan.name}
                </h3>
                
                <div className="flex mb-3">
                  <span className="w-16 h-1 bg-green-600"></span>
                </div>
                
                <p className="font-semibold text-sm font-regular mb-4 text-black" style={{fontFamily: 'Quicksand, sans-serif'}}>
                  {pimpinan.position}
                </p>
                
                {isKepalaSekolah && (
                  <a href="#">
                    <button className="text-sm font-semibold bg-gray-200 text-green-600 px-4 py-3 rounded-none font-bold border-0 inline-flex items-center justify-between" style={{fontFamily: 'Ubuntu, sans-serif'}}>
                      <span>Profil</span>
                      <span className="ml-2">→</span>
                    </button>
                  </a>
                )}
              </div>
            </div>
            
            {/* Desktop Layout */}
            <div className="hidden lg:flex w-full max-w-6xl mx-auto">
              {/* Left Column - Image */}
              <div className={`w-5/12 flex items-end justify-center relative ${layout === 'left' ? 'z-20' : 'z-0'}`}>
                <img 
                  draggable={false} 
                  alt={`${pimpinan.name} image`}
                  src={pimpinan.photo || '/default-avatar.jpg'}
                  className="max-w-md h-auto object-cover" 
                  style={{maxHeight: '700px', width: 'auto'}} 
                />
              </div>
              
              {/* Right Column - Content */}
              <div className={`w-7/12 pt-5 text-left ${layout === 'left' ? 'lg:text-right' : ''} flex items-center relative ${layout === 'right' ? 'z-10' : 'z-10'}`} style={{marginBottom: '10rem', fontFamily: 'Ubuntu, sans-serif'}}>
                <div>
                  <h4 className="text-lg font-medium text-black mb-2" style={{fontFamily: 'Ubuntu, sans-serif'}}>
                    {getTypeLabel(pimpinan.type)}
                  </h4>
                  
                  <h3 className="mb-2 text-3xl lg:text-4xl font-bold text-black" style={{fontFamily: 'Ubuntu, sans-serif'}}>
                    {pimpinan.name}
                  </h3>
                  
                  <div className={`flex ${layout === 'left' ? 'justify-start' : 'justify-end'} mb-3`}>
                    <span className="w-16 h-1 bg-green-600 mb-3"></span>
                  </div>
                  
                  <p className="font-bold text-lg font-semibold text-black mb-4" style={{fontFamily: 'Quicksand, sans-serif'}}>
                    {pimpinan.position}
                  </p>
                </div>
              </div>
            </div>
          </div>
          
          {/* Footer */}
          <div className="w-full h-16 bg-green-600 flex justify-center absolute bottom-0 mx-0 z-0">
            <div className="hidden lg:block lg:w-5/12"></div>
            <div className={`w-full lg:w-7/12 text-sm font-bold text-white py-3 ${layout === 'left' ? 'text-right' : 'text-left'} flex items-center ${layout === 'left' ? 'justify-end pr-4' : 'justify-start pl-4'}`} style={{fontFamily: 'Ubuntu, sans-serif'}}>
              {/* Footer content dapat ditambahkan di sini */}
            </div>
          </div>
        </div>
      </div>
    </section>
  )
}

export default PimpinanSMPDetail
```

### 2. Custom Hook untuk Data Fetching

```typescript
// hooks/usePimpinanSMP.ts
import { useState, useEffect } from 'react'
import { pimpinanSMPApi } from '@/lib/api'

export const usePimpinanSMP = () => {
  const [data, setData] = useState<any>(null)
  const [loading, setLoading] = useState(true)
  const [error, setError] = useState<string | null>(null)

  useEffect(() => {
    const fetchData = async () => {
      try {
        setLoading(true)
        setError(null)
        const completeData = await pimpinanSMPApi.getCompleteData()
        setData(completeData)
      } catch (err) {
        setError('Gagal memuat data pimpinan SMP')
        console.error('Error fetching pimpinan SMP data:', err)
      } finally {
        setLoading(false)
      }
    }

    fetchData()
  }, [])

  return { data, loading, error }
}
```

## Data Structure

### Settings Object
```typescript
interface Settings {
  id: number
  title: string
  subtitle: string
  banner_desktop: string | null
  banner_mobile: string | null
  keunggulan_title: string
  keunggulan_subtitle: string
}
```

### Pimpinan Object
```typescript
interface Pimpinan {
  id: number
  name: string
  position: string
  photo: string | null
  bio: string | null
  education: string | null
  experience: string | null
  type: 'kepala_sekolah' | 'wakil_kepala_sekolah_kurikulum' | 'wakil_kepala_sekolah_kesiswaan' | 'wakil_kepala_sekolah_sdm_humas' | 'wakil_kepala_sekolah_aik' | 'wakil_kepala_sekolah_sarpras'
  order_index: number
  banner_desktop: string | null
  banner_mobile: string | null
}
```

### Box Object
```typescript
interface Box {
  id: number
  title: string
  description: string
  icon: string
  image: string | null
  background_color: string
  order_index: number
}
```

## Tips Implementasi

1. **Error Handling**: Selalu handle error dengan baik dan berikan fallback UI
2. **Loading States**: Tampilkan loading indicator saat data sedang dimuat
3. **Image Fallbacks**: Gunakan default images untuk foto yang tidak tersedia
4. **Responsive Design**: Pastikan layout responsive untuk mobile dan desktop
5. **SEO**: Tambahkan meta tags yang sesuai untuk halaman pimpinan SMP
6. **Performance**: Gunakan lazy loading untuk images dan implementasikan caching

## Testing API

Untuk testing API, gunakan tools seperti Postman atau curl:

```bash
# Test complete endpoint
curl http://localhost:8000/api/v1/pimpinan-smp/complete

# Test settings endpoint
curl http://localhost:8000/api/v1/pimpinan-smp/settings

# Test pimpinan endpoint
curl http://localhost:8000/api/v1/pimpinan-smp
```

## Troubleshooting

1. **CORS Error**: Pastikan CORS sudah dikonfigurasi di backend Laravel
2. **Image Not Loading**: Periksa storage link dan file permissions
3. **API Not Responding**: Pastikan server Laravel berjalan di port 8000
4. **Data Empty**: Periksa apakah seeder sudah dijalankan dengan benar 
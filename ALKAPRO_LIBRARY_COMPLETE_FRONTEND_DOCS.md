# 📚 Alkapro Library - Complete Frontend Documentation 2025

## 🎯 Overview
Dokumentasi lengkap implementasi frontend untuk sistem Alkapro Library yang terintegrasi dengan backend Laravel API. Dibuat berdasarkan backend yang telah berhasil di-deploy dan dikonfirmasi working.

---

## ✅ Backend Status (Confirmed Working)
- ✅ **Database**: `alkapro_library_settings` table created successfully
- ✅ **Admin Panel**: "Pengaturan Alkapro Library" menu available in Filament
- ✅ **API Endpoints**: 4 endpoints ready and tested
- ✅ **Model**: AlkaproLibrarySettings with complete field structure
- ✅ **Routes**: All API routes registered in `/api/v1/`

---

## 🔗 Production API Endpoints

```typescript
// Base API Configuration
const API_BASE = 'https://api.alkapro.id/api/v1'

// Available Endpoints (All Working ✅)
export const ALKAPRO_API = {
  // Complete data with all sections
  complete: `${API_BASE}/alkapro-library/complete`,
  
  // Settings only (basic info, hero, intro, features)
  settings: `${API_BASE}/alkapro-library/settings`,
  
  // Gallery images only
  gallery: `${API_BASE}/alkapro-library/gallery`,
  
  // Pamphlet images only
  pamphlets: `${API_BASE}/alkapro-library/pamphlets`
} as const

// API Response Format
interface ApiResponse<T> {
  success: boolean
  message: string
  data: T
  error?: string
}
```

---

## 📋 TypeScript Interfaces

```typescript
// Main Data Interface
interface AlkaproLibraryData {
  id: number
  
  // Basic Information
  basic_info: {
    title: string                    // "Alkapro Library"
    subtitle: string                 // "Perpustakaan Modern SMP..."
    banner_desktop: string | null    // Desktop banner image
    banner_mobile: string | null     // Mobile banner image
  }
  
  // Hero Section
  hero_section: {
    title: string                    // Hero title
    subtitle: string                 // Hero subtitle
    image: string | null             // Hero background image
  }
  
  // Introduction Section
  introduction: {
    badge_text: string               // "Perpustakaan Sekolah"
    title: string                    // "Selamat Datang di..."
    description: string              // Long description text
    featured_image: string | null    // Introduction image
  }
  
  // Features Section
  features: {
    title: string                    // "Koleksi Lengkap & Fasilitas Modern"
    collection_features: string[]    // Array of collection features
    facility_features: string[]      // Array of facility features
  }
  
  // Conditional Sections (can be null if disabled in admin)
  gallery?: {
    images: string[]
    auto_slide: boolean
    slide_interval: number
  } | null
  
  pamphlets?: {
    images: string[]
    auto_slide: boolean
    slide_interval: number
  } | null
  
  programs?: {
    title: string
    description: string
    reading_club: {
      title: string
      description: string
      image: string | null
    }
    digital_library: {
      title: string
      description: string
      image: string | null
    }
  } | null
  
  additional_services?: {
    title: string
    description: string
    services: AdditionalService[]
  } | null
  
  service_hours?: {
    title: string
    weekday_hours: string
    weekend_hours: string
    note: string
  } | null
  
  social_media?: {
    instagram_username: string | null
    instagram_url: string | null
    facebook_url: string | null
    twitter_url: string | null
    youtube_url: string | null
  } | null
  
  call_to_action?: {
    title: string
    description: string
    background_image: string | null
    primary_button: {
      text: string
      url: string
    }
    secondary_button: {
      text: string
      url: string
    }
  } | null
  
  // SEO Data
  seo: {
    meta_title: string
    meta_description: string
    meta_keywords: string
  }
  
  // Status
  is_active: boolean
  updated_at: string
}

// Additional Service Interface
interface AdditionalService {
  title: string
  description: string
  icon: 'search' | 'monitor' | 'users' | 'file-text'
}
```

---

## 🎯 React Hook Implementation

```typescript
// hooks/useAlkaproLibrary.ts
import { useState, useEffect, useCallback } from 'react'

interface UseAlkaproLibraryOptions {
  endpoint?: 'complete' | 'settings' | 'gallery' | 'pamphlets'
  autoRefresh?: boolean
  refreshInterval?: number
}

interface UseAlkaproLibraryReturn<T> {
  data: T | null
  loading: boolean
  error: string | null
  refetch: () => Promise<void>
  lastUpdated: Date | null
}

export function useAlkaproLibrary<T = AlkaproLibraryData>(
  options: UseAlkaproLibraryOptions = {}
): UseAlkaproLibraryReturn<T> {
  const { 
    endpoint = 'complete', 
    autoRefresh = false, 
    refreshInterval = 300000 // 5 minutes
  } = options

  const [data, setData] = useState<T | null>(null)
  const [loading, setLoading] = useState(true)
  const [error, setError] = useState<string | null>(null)
  const [lastUpdated, setLastUpdated] = useState<Date | null>(null)

  const fetchData = useCallback(async () => {
    try {
      setLoading(true)
      setError(null)
      
      const url = ALKAPRO_API[endpoint]
      const response = await fetch(url, {
        method: 'GET',
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json',
        },
        cache: 'no-cache'
      })

      if (!response.ok) {
        throw new Error(`HTTP ${response.status}: ${response.statusText}`)
      }

      const result: ApiResponse<T> = await response.json()
      
      if (result.success && result.data) {
        setData(result.data)
        setLastUpdated(new Date())
      } else {
        throw new Error(result.message || 'Failed to fetch data')
      }
    } catch (err) {
      const errorMessage = err instanceof Error ? err.message : 'Unknown error occurred'
      setError(errorMessage)
      console.error(`Error fetching Alkapro Library ${endpoint}:`, err)
    } finally {
      setLoading(false)
    }
  }, [endpoint])

  useEffect(() => {
    fetchData()
  }, [fetchData])

  useEffect(() => {
    if (!autoRefresh) return
    const interval = setInterval(fetchData, refreshInterval)
    return () => clearInterval(interval)
  }, [autoRefresh, refreshInterval, fetchData])

  return { data, loading, error, refetch: fetchData, lastUpdated }
}

// Specialized hooks
export const useAlkaproComplete = () => 
  useAlkaproLibrary<AlkaproLibraryData>({ endpoint: 'complete' })

export const useAlkaproGallery = () => 
  useAlkaproLibrary<{ images: string[], auto_slide: boolean, slide_interval: number }>({ 
    endpoint: 'gallery' 
  })
```

---

## 🎨 Main Component Implementation

```tsx
// components/AlkaproLibraryPage.tsx
import React from 'react'
import { useAlkaproComplete } from '@/hooks/useAlkaproLibrary'

// Component imports
import { AlkaproHero } from './sections/AlkaproHero'
import { AlkaproIntro } from './sections/AlkaproIntro'
import { AlkaproFeatures } from './sections/AlkaproFeatures'
import { AlkaproGallery } from './sections/AlkaproGallery'
import { AlkaproPamphlets } from './sections/AlkaproPamphlets'
import { AlkaproPrograms } from './sections/AlkaproPrograms'
import { AlkaproServices } from './sections/AlkaproServices'
import { AlkaproServiceHours } from './sections/AlkaproServiceHours'
import { AlkaproSocialMedia } from './sections/AlkaproSocialMedia'
import { AlkaproCTA } from './sections/AlkaproCTA'
import { AlkaproLoading } from './AlkaproLoading'
import { AlkaproError } from './AlkaproError'
import { AlkaproSEO } from './AlkaproSEO'

interface AlkaproLibraryPageProps {
  className?: string
  showSEO?: boolean
}

export function AlkaproLibraryPage({ 
  className = '', 
  showSEO = true 
}: AlkaproLibraryPageProps) {
  const { data, loading, error, refetch } = useAlkaproComplete()

  if (loading) return <AlkaproLoading />
  if (error) return <AlkaproError error={error} onRetry={refetch} />
  if (!data) return <AlkaproError error="Data tidak tersedia" onRetry={refetch} />

  return (
    <>
      {showSEO && <AlkaproSEO data={data} />}
      
      <main className={`alkapro-library-page ${className}`}>
        {/* Core Sections - Always Shown */}
        <AlkaproHero data={data.hero_section} />
        <AlkaproIntro data={data.introduction} />
        <AlkaproFeatures data={data.features} />
        
        {/* Conditional Sections */}
        {data.gallery && (
          <AlkaproGallery data={data.gallery} title="Galeri Perpustakaan" />
        )}
        
        {data.pamphlets && (
          <AlkaproPamphlets data={data.pamphlets} title="Pamflet & Informasi" />
        )}
        
        {data.programs && <AlkaproPrograms data={data.programs} />}
        {data.additional_services && <AlkaproServices data={data.additional_services} />}
        {data.service_hours && <AlkaproServiceHours data={data.service_hours} />}
        {data.social_media && <AlkaproSocialMedia data={data.social_media} />}
        {data.call_to_action && <AlkaproCTA data={data.call_to_action} />}
      </main>
    </>
  )
}
```

---

## 🎨 Section Components

### Hero Section
```tsx
// components/sections/AlkaproHero.tsx
import React from 'react'

interface AlkaproHeroProps {
  data: {
    title: string
    subtitle: string
    image: string | null
  }
}

export function AlkaproHero({ data }: AlkaproHeroProps) {
  return (
    <section className="relative overflow-hidden bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 min-h-[600px] lg:min-h-[700px]">
      {/* Background Pattern */}
      <div className="absolute inset-0 opacity-10">
        <div className="absolute inset-0 bg-[url('/patterns/library-pattern.svg')] bg-repeat opacity-20" />
      </div>
      
      <div className="container mx-auto px-4 py-16 lg:py-24 relative z-10">
        <div className="grid lg:grid-cols-2 gap-12 items-center min-h-[500px]">
          {/* Text Content */}
          <div className="text-white space-y-8">
            {/* Badge */}
            <div className="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2 text-sm font-medium">
              <svg className="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              Perpustakaan Sekolah
            </div>
            
            {/* Main Title */}
            <h1 className="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight">
              {data.title}
            </h1>
            
            {/* Subtitle */}
            <p className="text-xl lg:text-2xl text-blue-100 leading-relaxed max-w-2xl">
              {data.subtitle}
            </p>
            
            {/* Action Buttons */}
            <div className="flex flex-col sm:flex-row gap-4 pt-4">
              <button 
                className="bg-white text-blue-600 px-8 py-4 rounded-lg font-bold text-lg hover:bg-blue-50 transition-all duration-300 inline-flex items-center gap-2"
                onClick={() => document.getElementById('alkapro-features')?.scrollIntoView({ behavior: 'smooth' })}
              >
                <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                Jelajahi Koleksi
              </button>
              
              <button 
                className="border-2 border-white text-white px-8 py-4 rounded-lg font-bold text-lg hover:bg-white hover:text-blue-600 transition-all duration-300"
                onClick={() => document.getElementById('alkapro-gallery')?.scrollIntoView({ behavior: 'smooth' })}
              >
                Lihat Galeri
              </button>
            </div>
          </div>
          
          {/* Hero Image */}
          {data.image && (
            <div className="relative">
              <img
                src={data.image.startsWith('http') ? data.image : `https://api.alkapro.id${data.image}`}
                alt={data.title}
                className="w-full h-auto rounded-2xl shadow-2xl"
              />
              <div className="absolute -top-4 -right-4 w-full h-full bg-white/10 rounded-2xl -z-10" />
            </div>
          )}
        </div>
      </div>
      
      {/* Scroll Indicator */}
      <div className="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <svg className="w-6 h-6 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 14l-7 7m0 0l-7-7m7 7V3" />
        </svg>
      </div>
    </section>
  )
}
```

### Features Section
```tsx
// components/sections/AlkaproFeatures.tsx
import React from 'react'

interface AlkaproFeaturesProps {
  data: {
    title: string
    collection_features: string[]
    facility_features: string[]
  }
}

export function AlkaproFeatures({ data }: AlkaproFeaturesProps) {
  return (
    <section id="alkapro-features" className="py-16 lg:py-24 bg-gray-50">
      <div className="container mx-auto px-4">
        {/* Section Header */}
        <div className="text-center mb-16">
          <h2 className="text-3xl lg:text-5xl font-bold text-gray-900 mb-6">
            {data.title}
          </h2>
          <div className="w-24 h-1 bg-gradient-to-r from-blue-600 to-indigo-600 mx-auto rounded-full" />
        </div>
        
        {/* Features Grid */}
        <div className="grid lg:grid-cols-2 gap-12 max-w-6xl mx-auto">
          {/* Collection Features */}
          <div className="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
            <div className="flex items-center gap-4 mb-8">
              <div className="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center">
                <svg className="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
              </div>
              <h3 className="text-2xl font-bold text-gray-900">
                📚 Koleksi Perpustakaan
              </h3>
            </div>
            
            <div className="space-y-4">
              {data.collection_features.map((feature, index) => (
                <div key={index} className="flex items-start gap-3">
                  <div className="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                    <svg className="w-3 h-3 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                      <path fillRule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clipRule="evenodd" />
                    </svg>
                  </div>
                  <p className="text-gray-700 leading-relaxed">{feature}</p>
                </div>
              ))}
            </div>
          </div>
          
          {/* Facility Features */}
          <div className="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
            <div className="flex items-center gap-4 mb-8">
              <div className="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center">
                <svg className="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
              </div>
              <h3 className="text-2xl font-bold text-gray-900">
                🏢 Fasilitas Modern
              </h3>
            </div>
            
            <div className="space-y-4">
              {data.facility_features.map((feature, index) => (
                <div key={index} className="flex items-start gap-3">
                  <div className="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                    <svg className="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                      <path fillRule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clipRule="evenodd" />
                    </svg>
                  </div>
                  <p className="text-gray-700 leading-relaxed">{feature}</p>
                </div>
              ))}
            </div>
          </div>
        </div>
      </div>
    </section>
  )
}
```

---

## 🔧 Utility Components

### Loading Component
```tsx
// components/AlkaproLoading.tsx
export function AlkaproLoading() {
  return (
    <div className="min-h-screen">
      {/* Hero Loading */}
      <div className="bg-gradient-to-br from-blue-600 to-indigo-800 py-24">
        <div className="container mx-auto px-4">
          <div className="grid lg:grid-cols-2 gap-12 items-center">
            <div className="space-y-6">
              <div className="h-8 bg-white/20 rounded-lg animate-pulse" />
              <div className="h-12 bg-white/20 rounded-lg animate-pulse" />
              <div className="h-6 bg-white/20 rounded-lg animate-pulse w-3/4" />
              <div className="flex gap-4">
                <div className="h-12 w-32 bg-white/20 rounded-lg animate-pulse" />
                <div className="h-12 w-32 bg-white/20 rounded-lg animate-pulse" />
              </div>
            </div>
            <div className="h-64 bg-white/20 rounded-2xl animate-pulse" />
          </div>
        </div>
      </div>
      
      {/* Content Loading */}
      <div className="py-16 bg-gray-50">
        <div className="container mx-auto px-4">
          <div className="text-center mb-16">
            <div className="h-10 bg-gray-300 rounded animate-pulse mx-auto w-1/2 mb-6" />
            <div className="w-24 h-1 bg-gray-300 rounded-full mx-auto animate-pulse" />
          </div>
          <div className="grid lg:grid-cols-2 gap-12">
            {[1, 2].map((i) => (
              <div key={i} className="bg-white p-8 rounded-2xl shadow-lg">
                <div className="flex items-center gap-4 mb-8">
                  <div className="w-16 h-16 bg-gray-300 rounded-2xl animate-pulse" />
                  <div className="h-8 bg-gray-300 rounded animate-pulse flex-1" />
                </div>
                <div className="space-y-4">
                  {[1, 2, 3, 4].map((j) => (
                    <div key={j} className="flex items-start gap-3">
                      <div className="w-6 h-6 bg-gray-300 rounded-full animate-pulse flex-shrink-0" />
                      <div className="h-4 bg-gray-300 rounded animate-pulse flex-1" />
                    </div>
                  ))}
                </div>
              </div>
            ))}
          </div>
        </div>
      </div>
    </div>
  )
}
```

### Error Component
```tsx
// components/AlkaproError.tsx
interface AlkaproErrorProps {
  error?: string
  onRetry?: () => void
}

export function AlkaproError({ error, onRetry }: AlkaproErrorProps) {
  return (
    <div className="min-h-screen bg-gray-50 flex items-center justify-center py-24">
      <div className="container mx-auto px-4 text-center">
        <div className="max-w-md mx-auto">
          <div className="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg className="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
            </svg>
          </div>
          <h3 className="text-xl font-bold text-gray-900 mb-4">
            Gagal Memuat Data Perpustakaan
          </h3>
          <p className="text-gray-600 mb-6">
            {error || 'Terjadi kesalahan saat memuat informasi perpustakaan. Silakan coba lagi.'}
          </p>
          {onRetry && (
            <button 
              onClick={onRetry}
              className="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors inline-flex items-center gap-2"
            >
              <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
              </svg>
              Coba Lagi
            </button>
          )}
        </div>
      </div>
    </div>
  )
}
```

---

## 🚀 Quick Implementation

### Step 1: Install Dependencies
```bash
npm install react next tailwindcss swiper
npm install -D @types/react @types/node typescript
```

### Step 2: Create Hook File
```typescript
// hooks/useAlkaproLibrary.ts
// Copy the hook implementation above
```

### Step 3: Create Main Component
```typescript
// components/AlkaproLibraryPage.tsx
// Copy the main component implementation above
```

### Step 4: Create Page
```typescript
// pages/perpustakaan.tsx (Next.js)
import { AlkaproLibraryPage } from '@/components/AlkaproLibraryPage'

export default function PerpustakaanPage() {
  return <AlkaproLibraryPage />
}
```

### Step 5: Add Styles
```css
/* styles/globals.css */
@tailwind base;
@tailwind components;
@tailwind utilities;

/* Custom Alkapro styles */
.alkapro-library-page {
  @apply relative;
}

/* Animation classes */
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-fade-in-up {
  animation: fadeInUp 0.6s ease-out;
}
```

---

## 📱 Responsive Design

### Mobile Optimizations
```css
/* Mobile-first responsive classes */
@media (max-width: 640px) {
  .alkapro-hero h1 {
    @apply text-3xl;
  }
  
  .alkapro-hero .hero-buttons {
    @apply flex-col space-y-3;
  }
}

@media (min-width: 641px) and (max-width: 1024px) {
  .alkapro-features {
    @apply grid-cols-1;
  }
}

@media (min-width: 1025px) {
  .alkapro-features {
    @apply grid-cols-2;
  }
}
```

---

## 🧪 Testing

### Basic Component Test
```tsx
import { render, screen } from '@testing-library/react'
import { AlkaproLibraryPage } from './AlkaproLibraryPage'

// Mock the hook
jest.mock('@/hooks/useAlkaproLibrary', () => ({
  useAlkaproComplete: () => ({
    data: mockData,
    loading: false,
    error: null,
    refetch: jest.fn()
  })
}))

test('renders Alkapro Library page', () => {
  render(<AlkaproLibraryPage />)
  expect(screen.getByText('Alkapro Library')).toBeInTheDocument()
})
```

---

## 🔧 Troubleshooting

### Common Issues

1. **API Connection Issues**
   - Check if API endpoints are accessible
   - Verify CORS settings
   - Check network connectivity

2. **Image Loading Issues**
   - Ensure image URLs are correct
   - Check if images exist on server
   - Implement fallback images

3. **TypeScript Errors**
   - Ensure all interfaces are properly imported
   - Check for missing type definitions
   - Verify API response structure

---

## 📈 Performance Tips

1. **Lazy Loading**: Implement lazy loading for images
2. **Code Splitting**: Split components into separate chunks
3. **Caching**: Implement proper caching

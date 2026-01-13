# 📚 Alkapro Library - Complete Frontend Integration Guide 2025

## 🚀 Overview
Panduan lengkap implementasi frontend untuk sistem Alkapro Library yang terintegrasi dengan backend Laravel API. Dokumentasi ini dibuat berdasarkan implementasi backend terbaru yang telah berhasil di-deploy.

---

## ✅ Backend Status (Confirmed Working)
- ✅ **Database Migration**: `alkapro_library_settings` table created
- ✅ **Filament Admin**: "Pengaturan Alkapro Library" menu available
- ✅ **API Controller**: 4 endpoints ready
- ✅ **Model**: AlkaproLibrarySettings with all fields
- ✅ **Routes**: API routes registered in `/api/v1/`

---

## 🔗 API Endpoints (Production Ready)

### Base Configuration
```typescript
// Production API Base URL
const API_BASE = 'https://api.alkapro.id/api/v1'

// Available Endpoints (All Working)
const ALKAPRO_ENDPOINTS = {
  // Complete data with all sections
  complete: `${API_BASE}/alkapro-library/complete`,
  
  // Settings only (basic info, hero, intro, features)
  settings: `${API_BASE}/alkapro-library/settings`,
  
  // Gallery images only
  gallery: `${API_BASE}/alkapro-library/gallery`,
  
  // Pamphlet images only
  pamphlets: `${API_BASE}/alkapro-library/pamphlets`
} as const
```

### API Response Structure
```typescript
// Standard API Response Format
interface ApiResponse<T> {
  success: boolean
  message: string
  data: T
  error?: string
}

// Complete Data Response
interface AlkaproLibraryCompleteResponse extends ApiResponse<AlkaproLibraryData> {}

// Settings Only Response  
interface AlkaproLibrarySettingsResponse extends ApiResponse<AlkaproLibrarySettings> {}

// Gallery Response
interface AlkaproLibraryGalleryResponse extends ApiResponse<{
  images: string[]
  auto_slide: boolean
  slide_interval: number
}> {}

// Pamphlets Response
interface AlkaproLibraryPamphletsResponse extends ApiResponse<{
  images: string[]
  auto_slide: boolean
  slide_interval: number
}> {}
```

---

## 📋 Complete TypeScript Interfaces

### Main Data Interface
```typescript
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
  
  // Gallery Section (Conditional)
  gallery?: {
    images: string[]                 // Array of gallery image URLs
    auto_slide: boolean              // Auto slide enabled
    slide_interval: number           // Slide interval in ms
  } | null
  
  // Pamphlets Section (Conditional)
  pamphlets?: {
    images: string[]                 // Array of pamphlet image URLs
    auto_slide: boolean              // Auto slide enabled
    slide_interval: number           // Slide interval in ms
  } | null
  
  // Programs Section (Conditional)
  programs?: {
    title: string                    // "Program Unggulan Perpustakaan"
    description: string              // Programs description
    reading_club: {
      title: string                  // "Reading Club Alkapro"
      description: string            // Reading club description
      image: string | null           // Reading club image
    }
    digital_library: {
      title: string                  // "Perpustakaan Digital"
      description: string            // Digital library description
      image: string | null           // Digital library image
    }
  } | null
  
  // Additional Services (Conditional)
  additional_services?: {
    title: string                    // "Layanan Tambahan"
    description: string              // Services description
    services: AdditionalService[]    // Array of services
  } | null
  
  // Service Hours (Conditional)
  service_hours?: {
    title: string                    // "Jam Layanan Perpustakaan"
    weekday_hours: string            // "07.30 - 14.30 WIB"
    weekend_hours: string            // "07.30 - 11.00 WIB"
    note: string                     // Additional notes
  } | null
  
  // Social Media (Conditional)
  social_media?: {
    instagram_username: string | null // "@alkapro.library"
    instagram_url: string | null      // Instagram URL
    facebook_url: string | null       // Facebook URL
    twitter_url: string | null        // Twitter URL
    youtube_url: string | null        // YouTube URL
  } | null
  
  // Call to Action (Conditional)
  call_to_action?: {
    title: string                    // CTA title
    description: string              // CTA description
    background_image: string | null  // CTA background image
    primary_button: {
      text: string                   // Primary button text
      url: string                    // Primary button URL
    }
    secondary_button: {
      text: string                   // Secondary button text
      url: string                    // Secondary button URL
    }
  } | null
  
  // SEO Data
  seo: {
    meta_title: string               // Page meta title
    meta_description: string         // Page meta description
    meta_keywords: string            // Page meta keywords
  }
  
  // Status & Timestamps
  is_active: boolean                 // Library is active
  updated_at: string                 // Last update timestamp
}

// Additional Service Interface
interface AdditionalService {
  title: string                      // Service title
  description: string                // Service description
  icon: 'search' | 'monitor' | 'users' | 'file-text' // Icon type
}

// Settings Only Interface (Subset of complete data)
interface AlkaproLibrarySettings {
  id: number
  basic_info: AlkaproLibraryData['basic_info']
  hero_section: AlkaproLibraryData['hero_section']
  introduction: AlkaproLibraryData['introduction']
  features: AlkaproLibraryData['features']
  display_settings: {
    show_gallery: boolean
    show_pamphlets: boolean
    show_service_hours: boolean
    show_social_media: boolean
    show_programs: boolean
    show_additional_services: boolean
    show_cta_section: boolean
  }
  is_active: boolean
  updated_at: string
}
```

---

## 🎯 React Hooks Implementation

### Main Data Hook
```typescript
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
      
      const url = ALKAPRO_ENDPOINTS[endpoint]
      const response = await fetch(url, {
        method: 'GET',
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json',
        },
        // Add cache control for better performance
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

  // Initial fetch
  useEffect(() => {
    fetchData()
  }, [fetchData])

  // Auto refresh
  useEffect(() => {
    if (!autoRefresh) return

    const interval = setInterval(fetchData, refreshInterval)
    return () => clearInterval(interval)
  }, [autoRefresh, refreshInterval, fetchData])

  return {
    data,
    loading,
    error,
    refetch: fetchData,
    lastUpdated
  }
}

// Specialized hooks for specific endpoints
export const useAlkaproLibraryComplete = () => 
  useAlkaproLibrary<AlkaproLibraryData>({ endpoint: 'complete' })

export const useAlkaproLibrarySettings = () => 
  useAlkaproLibrary<AlkaproLibrarySettings>({ endpoint: 'settings' })

export const useAlkaproLibraryGallery = () => 
  useAlkaproLibrary<{ images: string[], auto_slide: boolean, slide_interval: number }>({ 
    endpoint: 'gallery' 
  })

export const useAlkaproLibraryPamphlets = () => 
  useAlkaproLibrary<{ images: string[], auto_slide: boolean, slide_interval: number }>({ 
    endpoint: 'pamphlets' 
  })
```

---

## 🎨 Complete Component Library

### 1. Main Container Component
```tsx
import React from 'react'
import { useAlkaproLibraryComplete } from '@/hooks/useAlkaproLibrary'
import { AlkaproLibraryLoading } from './AlkaproLibraryLoading'
import { AlkaproLibraryError } from './AlkaproLibraryError'
import { AlkaproLibrarySEO } from './AlkaproLibrarySEO'

// Import all section components
import { AlkaproHeroSection } from './sections/AlkaproHeroSection'
import { AlkaproIntroSection } from './sections/AlkaproIntroSection'
import { AlkaproFeaturesSection } from './sections/AlkaproFeaturesSection'
import { AlkaproGallerySection } from './sections/AlkaproGallerySection'
import { AlkaproPamphletsSection } from './sections/AlkaproPamphletsSection'
import { AlkaproProgramsSection } from './sections/AlkaproProgramsSection'
import { AlkaproServicesSection } from './sections/AlkaproServicesSection'
import { AlkaproServiceHoursSection } from './sections/AlkaproServiceHoursSection'
import { AlkaproSocialMediaSection } from './sections/AlkaproSocialMediaSection'
import { AlkaproCtaSection } from './sections/AlkaproCtaSection'

interface AlkaproLibraryPageProps {
  className?: string
  showSEO?: boolean
}

export function AlkaproLibraryPage({ 
  className = '', 
  showSEO = true 
}: AlkaproLibraryPageProps) {
  const { data, loading, error, refetch, lastUpdated } = useAlkaproLibraryComplete()

  // Loading state
  if (loading) {
    return <AlkaproLibraryLoading />
  }

  // Error state
  if (error) {
    return (
      <AlkaproLibraryError 
        error={error} 
        onRetry={refetch}
        lastUpdated={lastUpdated}
      />
    )
  }

  // No data state
  if (!data) {
    return (
      <AlkaproLibraryError 
        error="Data perpustakaan tidak tersedia" 
        onRetry={refetch}
      />
    )
  }

  return (
    <>
      {/* SEO Meta Tags */}
      {showSEO && <AlkaproLibrarySEO data={data} />}
      
      {/* Main Content */}
      <main className={`alkapro-library-page ${className}`}>
        {/* Hero Section - Always shown */}
        <AlkaproHeroSection data={data.hero_section} />
        
        {/* Introduction Section - Always shown */}
        <AlkaproIntroSection data={data.introduction} />
        
        {/* Features Section - Always shown */}
        <AlkaproFeaturesSection data={data.features} />
        
        {/* Gallery Section - Conditional */}
        {data.gallery && (
          <AlkaproGallerySection 
            data={data.gallery} 
            title="Galeri Perpustakaan"
          />
        )}
        
        {/* Pamphlets Section - Conditional */}
        {data.pamphlets && (
          <AlkaproPamphletsSection 
            data={data.pamphlets}
            title="Pamflet & Informasi"
          />
        )}
        
        {/* Programs Section - Conditional */}
        {data.programs && (
          <AlkaproProgramsSection data={data.programs} />
        )}
        
        {/* Additional Services - Conditional */}
        {data.additional_services && (
          <AlkaproServicesSection data={data.additional_services} />
        )}
        
        {/* Service Hours - Conditional */}
        {data.service_hours && (
          <AlkaproServiceHoursSection data={data.service_hours} />
        )}
        
        {/* Social Media - Conditional */}
        {data.social_media && (
          <AlkaproSocialMediaSection data={data.social_media} />
        )}
        
        {/* Call to Action - Conditional */}
        {data.call_to_action && (
          <AlkaproCtaSection data={data.call_to_action} />
        )}
      </main>
    </>
  )
}
```

### 2. Hero Section Component
```tsx
import React from 'react'
import { OptimizedImage } from '@/components/ui/OptimizedImage'
import { Button } from '@/components/ui/Button'

interface AlkaproHeroSectionProps {
  data: {
    title: string
    subtitle: string
    image: string | null
  }
}

export function AlkaproHeroSection({ data }: AlkaproHeroSectionProps) {
  return (
    <section className="alkapro-hero relative overflow-hidden bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 min-h-[600px] lg:min-h-[700px]">
      {/* Background Pattern */}
      <div className="absolute inset-0 opacity-10">
        <div className="absolute inset-0 bg-[url('/patterns/library-pattern.svg')] bg-repeat opacity-20" />
      </div>
      
      {/* Content Container */}
      <div className="container mx-auto px-4 py-16 lg:py-24 relative z-10">
        <div className="grid lg:grid-cols-2 gap-12 items-center min-h-[500px]">
          {/* Text Content */}
          <div className="text-white space-y-8 animate-fade-in-up">
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
              <Button 
                variant="primary"
                size="lg"
                className="bg-white text-blue-600 hover:bg-blue-50 shadow-lg hover:shadow-xl transition-all duration-300"
                onClick={() => {
                  // Scroll to gallery or features section
                  document.getElementById('alkapro-features')?.scrollIntoView({ 
                    behavior: 'smooth' 
                  })
                }}
              >
                <svg className="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                Jelajahi Koleksi
              </Button>
              
              <Button 
                variant="outline"
                size="lg"
                className="border-2 border-white text-white hover:bg-white hover:text-blue-600 transition-all duration-300"
                onClick={() => {
                  document.getElementById('alkapro-gallery')?.scrollIntoView({ 
                    behavior: 'smooth' 
                  })
                }}
              >
                <svg className="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Lihat Galeri
              </Button>
            </div>
          </div>
          
          {/* Hero Image */}
          {data.image && (
            <div className="relative animate-fade-in-up animation-delay-300">
              <div className="relative z-10">
                <OptimizedImage
                  src={data.image}
                  alt={data.title}
                  className="w-full h-auto rounded-2xl shadow-2xl"
                  priority={true}
                />
              </div>
              
              {/* Decorative Elements */}
              <div className="absolute -top-4 -right-4 w-full h-full bg-white/10 rounded-2xl -z-10" />
              <div className="absolute -bottom-4 -left-4 w-full h-full bg-white/5 rounded-2xl -z-20" />
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

### 3. Features Section Component
```tsx
import React from 'react'
import { Card } from '@/components/ui/Card'

interface AlkaproFeaturesSectionProps {
  data: {
    title: string
    collection_features: string[]
    facility_features: string[]
  }
}

export function AlkaproFeaturesSection({ data }: AlkaproFeaturesSectionProps) {
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
          <Card className="p-8 hover:shadow-xl transition-shadow duration-300">
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
                <div key={index} className="flex items-start gap-3 group">
                  <div className="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5 group-hover:bg-blue-200 transition-colors">
                    <svg className="w-3 h-3 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                      <path fillRule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clipRule="evenodd" />
                    </svg>
                  </div>
                  <p className="text-gray-700 leading-relaxed group-hover:text-gray-900 transition-colors">
                    {feature}
                  </p>
                </div>
              ))}
            </div>
          </Card>
          
          {/* Facility Features */}
          <Card className="p-8 hover:shadow-xl transition-shadow duration-300">
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
                <div key={index} className="flex items-start gap-3 group">
                  <div className="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5 group-hover:bg-green-200 transition-colors">
                    <svg className="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                      <path fillRule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clipRule="evenodd" />
                    </svg>
                  </div>
                  <p className="text-gray-700 leading-relaxed group-hover:text-gray-900 transition-colors">
                    {feature}
                  </p>
                </div>
              ))}
            </div>
          </Card>
        </div>
      </div>
    </section>
  )
}
```

### 4. Gallery Section with Swiper
```tsx
import React, { useState } from 'react'
import { Swiper, SwiperSlide } from 'swiper/react'
import { Autoplay, Pagination, Navigation, Thumbs } from 'swiper/modules'
import { OptimizedImage } from '@/components/ui/OptimizedImage'
import { Modal } from '@/components/ui/Modal'

// Import Swiper styles
import 'swiper/css'
import 'swiper/css/pagination'
import 'swiper/css/navigation'
import 'swiper/css/thumbs'

interface AlkaproGallerySectionProps {
  data: {
    images: string[]
    auto_slide: boolean
    slide_interval: number
  }
  title: string
}

export function AlkaproGallerySection({ data, title }: AlkaproGallerySectionProps) {
  const [selectedImage, setSelectedImage] = useState<string | null>(null)
  const [thumbsSwiper, setThumbsSwiper] = useState<any>(null)

  if (!data.images || data.images.length === 0) {
    return null
  }

  return (
    <>
      <section id="alkapro-gallery" className="py-16 lg:py-24 bg-white">
        <div className="container mx-auto px-4">
          {/* Section Header */}
          <div className="text-center mb-12">
            <h2 className="text-3xl lg:text-5xl font-bold text-gray-900 mb-4">
              {title}
            </h2>
            <p className="text-lg text-gray-600 max-w-2xl mx-auto">
              Lihat suasana dan fasilitas perpustakaan kami yang modern dan nyaman
            </p>
            <div className="w-24 h-1 bg-gradient-to-r from-blue-600 to-indigo-600 mx-auto rounded-full mt-6" />
          </div>
          
          {/* Main Gallery Swiper */}
          <div className="mb-8">
            <Swiper
              modules={[Autoplay, Pagination, Navigation, Thumbs]}
              spaceBetween={30}
              slidesPerView={1}
              autoplay={data.auto_slide ? {
                delay: data.slide_interval,
                disableOnInteraction: false,
                pauseOnMouseEnter: true
              } : false}
              pagination={{ 
                clickable: true,
                dynamicBullets: true
              }}
              navigation={true}
              thumbs={{ swiper: thumbsSwiper }}
              breakpoints={{
                640: { slidesPerView: 1 },
                768: { slidesPerView: 2 },
                1024: { slidesPerView: 3 },
              }}
              className="gallery-main-swiper"
            >
              {data.images.map((image, index) => (
                <SwiperSlide key={index}>
                  <div 
                    className="relative group cursor-pointer overflow-hidden rounded-xl"
                    onClick={() => setSelecte

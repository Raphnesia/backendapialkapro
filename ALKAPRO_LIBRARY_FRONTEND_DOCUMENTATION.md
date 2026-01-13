# 📚 Alkapro Library - Frontend Documentation

## Overview
Dokumentasi lengkap untuk implementasi frontend komponen Alkapro Library yang terintegrasi dengan backend Laravel API. Komponen ini menampilkan informasi perpustakaan sekolah dengan berbagai fitur modern dan interaktif.

---

## 🚀 Quick Start

### API Endpoints
```typescript
// Base API URL
<<<<<<< HEAD
const API_BASE = 'https://api.alkapro.id/api/v1'
=======
const API_BASE = 'https://api.raphnesia.my.id/api/v1'
>>>>>>> 01cf9e1bd0b1c9f8e46d93c6fdb38a4008df2eeb

// Available endpoints
const endpoints = {
  complete: `${API_BASE}/alkapro-library/complete`,    // Complete data
  settings: `${API_BASE}/alkapro-library/settings`,    // Settings only
  gallery: `${API_BASE}/alkapro-library/gallery`,      // Gallery images
  pamphlets: `${API_BASE}/alkapro-library/pamphlets`   // Pamphlet images
}
```

### Basic Implementation
```tsx
import { useEffect, useState } from 'react'

interface AlkaproLibraryData {
  // See complete interface below
}

export function AlkaproLibrarySection() {
  const [data, setData] = useState<AlkaproLibraryData | null>(null)
  const [loading, setLoading] = useState(true)

  useEffect(() => {
    fetchAlkaproLibraryData()
  }, [])

  const fetchAlkaproLibraryData = async () => {
    try {
      const response = await fetch('/api/proxy/alkapro-library/complete')
      const result = await response.json()
      setData(result.data)
    } catch (error) {
      console.error('Error fetching Alkapro Library data:', error)
    } finally {
      setLoading(false)
    }
  }

  if (loading) return <AlkaproLibraryLoading />
  if (!data) return <AlkaproLibraryError />

  return <AlkaproLibraryComponent data={data} />
}
```

---

## 📋 Data Structure & TypeScript Interfaces

### Complete Data Interface
```typescript
interface AlkaproLibraryData {
  id: number
  basic_info: {
    title: string
    subtitle: string
    banner_desktop: string | null
    banner_mobile: string | null
  }
  hero_section: {
    title: string
    subtitle: string
    image: string | null
  }
  introduction: {
    badge_text: string
    title: string
    description: string
    featured_image: string | null
  }
  features: {
    title: string
    collection_features: string[]
    facility_features: string[]
  }
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
  seo: {
    meta_title: string
    meta_description: string
    meta_keywords: string
  }
  is_active: boolean
  updated_at: string
}

interface AdditionalService {
  title: string
  description: string
  icon: string // 'search' | 'monitor' | 'users' | 'file-text'
}
```

---

## 🎨 Component Structure

### Main Component
```tsx
interface AlkaproLibraryProps {
  data: AlkaproLibraryData
  className?: string
}

export function AlkaproLibraryComponent({ data, className }: AlkaproLibraryProps) {
  return (
    <div className={`alkapro-library-section ${className || ''}`}>
      {/* Hero Section */}
      <AlkaproHeroSection data={data.hero_section} />
      
      {/* Introduction Section */}
      <AlkaproIntroSection data={data.introduction} />
      
      {/* Features Section */}
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
    </div>
  )
}
```

### Hero Section Component
```tsx
interface AlkaproHeroProps {
  data: {
    title: string
    subtitle: string
    image: string | null
  }
}

export function AlkaproHeroSection({ data }: AlkaproHeroProps) {
  return (
    <section className="alkapro-hero relative overflow-hidden bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800">
      <div className="container mx-auto px-4 py-16 lg:py-24">
        <div className="grid lg:grid-cols-2 gap-12 items-center">
          <div className="text-white space-y-6">
            <h1 className="text-4xl lg:text-6xl font-bold leading-tight">
              {data.title}
            </h1>
            <p className="text-xl lg:text-2xl text-blue-100 leading-relaxed">
              {data.subtitle}
            </p>
            <div className="flex flex-wrap gap-4">
              <button className="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition-colors">
                Jelajahi Koleksi
              </button>
              <button className="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition-colors">
                Lihat Fasilitas
              </button>
            </div>
          </div>
          {data.image && (
            <div className="relative">
              <img 
                src={data.image} 
                alt={data.title}
                className="w-full h-auto rounded-2xl shadow-2xl"
              />
            </div>
          )}
        </div>
      </div>
    </section>
  )
}
```

### Introduction Section Component
```tsx
interface AlkaproIntroProps {
  data: {
    badge_text: string
    title: string
    description: string
    featured_image: string | null
  }
}

export function AlkaproIntroSection({ data }: AlkaproIntroProps) {
  return (
    <section className="py-16 lg:py-24 bg-gray-50">
      <div className="container mx-auto px-4">
        <div className="grid lg:grid-cols-2 gap-12 items-center">
          <div className="space-y-6">
            <span className="inline-block bg-blue-100 text-blue-600 px-4 py-2 rounded-full text-sm font-semibold">
              {data.badge_text}
            </span>
            <h2 className="text-3xl lg:text-5xl font-bold text-gray-900 leading-tight">
              {data.title}
            </h2>
            <p className="text-lg text-gray-600 leading-relaxed">
              {data.description}
            </p>
          </div>
          {data.featured_image && (
            <div className="relative">
              <img 
                src={data.featured_image} 
                alt={data.title}
                className="w-full h-auto rounded-2xl shadow-lg"
              />
            </div>
          )}
        </div>
      </div>
    </section>
  )
}
```

### Features Section Component
```tsx
interface AlkaproFeaturesProps {
  data: {
    title: string
    collection_features: string[]
    facility_features: string[]
  }
}

export function AlkaproFeaturesSection({ data }: AlkaproFeaturesProps) {
  return (
    <section className="py-16 lg:py-24">
      <div className="container mx-auto px-4">
        <div className="text-center mb-16">
          <h2 className="text-3xl lg:text-5xl font-bold text-gray-900 mb-6">
            {data.title}
          </h2>
        </div>
        
        <div className="grid md:grid-cols-2 gap-12">
          {/* Collection Features */}
          <div className="space-y-6">
            <h3 className="text-2xl font-bold text-gray-900 mb-6">
              📚 Koleksi Perpustakaan
            </h3>
            <div className="space-y-4">
              {data.collection_features.map((feature, index) => (
                <div key={index} className="flex items-start gap-3">
                  <div className="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                    <svg className="w-3 h-3 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                      <path fillRule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clipRule="evenodd" />
                    </svg>
                  </div>
                  <p className="text-gray-700">{feature}</p>
                </div>
              ))}
            </div>
          </div>
          
          {/* Facility Features */}
          <div className="space-y-6">
            <h3 className="text-2xl font-bold text-gray-900 mb-6">
              🏢 Fasilitas Modern
            </h3>
            <div className="space-y-4">
              {data.facility_features.map((feature, index) => (
                <div key={index} className="flex items-start gap-3">
                  <div className="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                    <svg className="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                      <path fillRule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clipRule="evenodd" />
                    </svg>
                  </div>
                  <p className="text-gray-700">{feature}</p>
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

### Gallery Section Component
```tsx
import { Swiper, SwiperSlide } from 'swiper/react'
import { Autoplay, Pagination, Navigation } from 'swiper/modules'

interface AlkaproGalleryProps {
  data: {
    images: string[]
    auto_slide: boolean
    slide_interval: number
  }
  title: string
}

export function AlkaproGallerySection({ data, title }: AlkaproGalleryProps) {
  if (!data.images || data.images.length === 0) return null

  return (
    <section className="py-16 lg:py-24 bg-gray-50">
      <div className="container mx-auto px-4">
        <div className="text-center mb-12">
          <h2 className="text-3xl lg:text-5xl font-bold text-gray-900 mb-4">
            {title}
          </h2>
          <p className="text-lg text-gray-600">
            Lihat suasana dan fasilitas perpustakaan kami
          </p>
        </div>
        
        <Swiper
          modules={[Autoplay, Pagination, Navigation]}
          spaceBetween={30}
          slidesPerView={1}
          autoplay={data.auto_slide ? {
            delay: data.slide_interval,
            disableOnInteraction: false,
          } : false}
          pagination={{ clickable: true }}
          navigation={true}
          breakpoints={{
            640: { slidesPerView: 2 },
            1024: { slidesPerView: 3 },
          }}
          className="gallery-swiper"
        >
          {data.images.map((image, index) => (
            <SwiperSlide key={index}>
              <div className="relative group cursor-pointer">
                <img 
                  src={image} 
                  alt={`Gallery ${index + 1}`}
                  className="w-full h-64 object-cover rounded-xl shadow-lg group-hover:shadow-xl transition-shadow"
                />
                <div className="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all rounded-xl" />
              </div>
            </SwiperSlide>
          ))}
        </Swiper>
      </div>
    </section>
  )
}
```

### Programs Section Component
```tsx
interface AlkaproProgramsProps {
  data: {
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
  }
}

export function AlkaproProgramsSection({ data }: AlkaproProgramsProps) {
  return (
    <section className="py-16 lg:py-24">
      <div className="container mx-auto px-4">
        <div className="text-center mb-16">
          <h2 className="text-3xl lg:text-5xl font-bold text-gray-900 mb-6">
            {data.title}
          </h2>
          <p className="text-lg text-gray-600 max-w-3xl mx-auto">
            {data.description}
          </p>
        </div>
        
        <div className="grid md:grid-cols-2 gap-8">
          {/* Reading Club */}
          <div className="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
            {data.reading_club.image && (
              <img 
                src={data.reading_club.image} 
                alt={data.reading_club.title}
                className="w-full h-48 object-cover"
              />
            )}
            <div className="p-8">
              <h3 className="text-2xl font-bold text-gray-900 mb-4">
                📖 {data.reading_club.title}
              </h3>
              <p className="text-gray-600 leading-relaxed">
                {data.reading_club.description}
              </p>
            </div>
          </div>
          
          {/* Digital Library */}
          <div className="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
            {data.digital_library.image && (
              <img 
                src={data.digital_library.image} 
                alt={data.digital_library.title}
                className="w-full h-48 object-cover"
              />
            )}
            <div className="p-8">
              <h3 className="text-2xl font-bold text-gray-900 mb-4">
                💻 {data.digital_library.title}
              </h3>
              <p className="text-gray-600 leading-relaxed">
                {data.digital_library.description}
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
  )
}
```

### Additional Services Component
```tsx
interface AlkaproServicesProps {
  data: {
    title: string
    description: string
    services: Array<{
      title: string
      description: string
      icon: string
    }>
  }
}

const getServiceIcon = (iconName: string) => {
  const icons = {
    search: (
      <svg className="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
      </svg>
    ),
    monitor: (
      <svg className="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
      </svg>
    ),
    users: (
      <svg className="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
      </svg>
    ),
    'file-text': (
      <svg className="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
      </svg>
    )
  }
  return icons[iconName as keyof typeof icons] || icons.search
}

export function AlkaproServicesSection({ data }: AlkaproServicesProps) {
  return (
    <section className="py-16 lg:py-24 bg-gray-50">
      <div className="container mx-auto px-4">
        <div className="text-center mb-16">
          <h2 className="text-3xl lg:text-5xl font-bold text-gray-900 mb-6">
            {data.title}
          </h2>
          <p className="text-lg text-gray-600 max-w-3xl mx-auto">
            {data.description}
          </p>
        </div>
        
        <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
          {data.services.map((service, index) => (
            <div key={index} className="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow text-center">
              <div className="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-6 text-blue-600">
                {getServiceIcon(service.icon)}
              </div>
              <h3 className="text-xl font-bold text-gray-900 mb-4">
                {service.title}
              </h3>
              <p className="text-gray-600 leading-relaxed">
                {service.description}
              </p>
            </div>
          ))}
        </div>
      </div>
    </section>
  )
}
```

### Service Hours Component
```tsx
interface AlkaproServiceHoursProps {
  data: {
    title: string
    weekday_hours: string
    weekend_hours: string
    note: string
  }
}

export function AlkaproServiceHoursSection({ data }: AlkaproServiceHoursProps) {
  return (
    <section className="py-16 lg:py-24">
      <div className="container mx-auto px-4">
        <div className="max-w-4xl mx-auto">
          <div className="text-center mb-12">
            <h2 className="text-3xl lg:text-5xl font-bold text-gray-900 mb-6">
              {data.title}
            </h2>
          </div>
          
          <div className="bg-white rounded-2xl shadow-lg p-8 lg:p-12">
            <div className="grid md:grid-cols-2 gap-8 mb-8">
              <div className="text-center">
                <div className="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                  <svg className="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                </div>
                <h3 className="text-xl font-bold text-gray-900 mb-2">Hari Kerja</h3>
                <p className="text-2xl font-bold text-blue-600">{data.weekday_hours}</p>
                <p className="text-gray-600 mt-2">Senin - Jumat</p>
              </div>
              
              <div className="text-center">
                <div className="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                  <svg className="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                </div>
                <h3 className="text-xl font-bold text-gray-900 mb-2">Akhir Pekan</h3>
                <p className="text-2xl font-bold text-green-600">{data.weekend_hours}</p>
                <p className="text-gray-600 mt-2">Sabtu</p>
              </div>
            </div>
            
            {data.note && (
              <div className="bg-yellow-50 border border-yellow-200 rounded-lg p-4 text-center">
                <p className="text-yellow-800">
                  <span className="font-semibold">Catatan:</span> {data.note}
                </p>
              </div>
            )}
          </div>
        </div>
      </div>
    </section>
  )
}
```

### Call to Action Component
```tsx
interface AlkaproCtaProps {
  data: {
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
  }
}

export function AlkaproCtaSection({ data }: AlkaproCtaProps) {
  return (
    <section 
      className="py-16 lg:py-24 relative overflow-hidden"
      style={{
        backgroundImage: data.background_image ? `url(${data.background_image})` : undefined,
        backgroundSize: 'cover',
        backgroundPosition: 'center',
      }}
    >
      <div className="absolute inset-0 bg-gradient-to-r from-blue-600/90 to-indigo-700/90" />
      
      <div className="container mx-auto px-4 relative z-10">
        <div className="max-w-4xl mx-auto text-center text-white">
          <h2 className="text-3xl lg:text-5xl font-bold mb-6 leading-tight">
            {data.title}
          </h2>
          <p className="text-xl lg:text-2xl mb-12 text-blue-100 leading-relaxed">
            {data.description}
          </p>
          
          <div className="flex flex-wrap justify-center gap-4">
            <a 
              href={data.primary_button.url}
              className="bg-white text-blue-600 px-8 py-4 rounded-lg font-bold text-lg hover:bg-blue-50 transition-colors inline-flex items-center gap-2"
            >
              {data.primary_button.text}
              <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M17 8l4 4m0 0l-4 4m4-4H3" />
              </svg>
            </a>
            <a 
              href={data.secondary_button.url}
              className="border-2 border-white text-white px-8 py-4 rounded-lg font-bold text-lg hover:bg-white hover:text-blue-600 transition-colors"
            >
              {data.secondary_button.text}
            </a>
          </div>
        </div>
      </div>
    </section>
  )
}
```

---

## 🔄 Custom Hooks

### useAlkaproLibrary Hook
```tsx
import { useState, useEffect } from 'react'

interface UseAlkaproLibraryReturn {
  data: AlkaproLibraryData | null
  loading: boolean
  error: string | null
  refetch: () => Promise<void>
}

export function useAlkaproLibrary(): UseAlkaproLibraryReturn {
  const [data, setData] = useState<AlkaproLibraryData | null>(null)
  const [loading, setLoading] = useState(true)
  const [error, setError] = useState<string | null>(null)

  const fetchData = async () => {
    try {
      setLoading(true)
      setError(null)
      
      const response = await fetch('/api/proxy/alkapro-library/complete')
      const result = await response.json()
      
      if (result.success) {
        setData(result.data)
      } else {
        throw new Error(result.message || 'Failed to fetch data')
      }
    } catch (err) {
      setError(err instanceof Error ? err.message : 'Unknown error')
      console.error('Error fetching Alkapro Library data:', err)
    } finally {
      setLoading(false)
    }
  }

  useEffect(() => {
    fetchData()
  }, [])

  return {
    data,
    loading,
    error,
    refetch: fetchData
  }
}
```

### useAlkaproGallery Hook
```tsx
export function useAlkaproGallery() {
  const [gallery, setGallery] = useState<any>(null)
  const [loading, setLoading] = useState(true)

  useEffect(() => {
    const fetchGallery = async () => {
      try {
        const response = await fetch('/api/proxy/alkapro-library/gallery')
        const result = await response.json()
        setGallery(result.data)
      } catch (error) {
        console.error('Error fetching gallery:', error)
      } finally {
        setLoading(false)
      }
    }

    fetchGallery()
  }, [])

  return { gallery, loading }
}
```

---

## 🎨 Styling & CSS

### Tailwind CSS Classes
```css
/* Custom classes for Alkapro Library */
.alkapro-library-section {
  @apply relative;
}

.alkapro-hero {
  @apply relative overflow-hidden;
  background: linear-gradient(135deg, #1e40af 0%, #3730a3 100%);
}

.gallery-swiper {
  @apply pb-12;
}

.gallery-swiper .swiper-pagination-bullet {
  @apply bg-blue-600 opacity-50;
}

.gallery-swiper .swiper-pagination-bullet-active {
  @apply opacity-100;
}

.gallery-swiper .swiper-button-next,
.gallery-swiper .swiper-button-prev {
  @apply text-blue-600;
}

/* Service cards hover effects */
.service-card {
  @apply transition-all duration-300 hover:scale-105;
}

/* CTA section overlay */
.cta-overlay {
  background: linear-gradient(135deg, rgba(30, 64, 175, 0.9) 0%, rgba(55, 48, 163, 0.9) 100%);
}
```

### Animation Classes
```css
/* Fade in animations */
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

/* Stagger animations for lists */
.stagger-animation > * {
  animation: fadeInUp 0.6s ease-out;
}

.stagger-animation > *:nth-child(1) { animation-delay: 0.1s; }
.stagger-animation > *:nth-child(2) { animation-delay: 0.2s; }
.stagger-animation > *:nth-child(3) { animation-delay: 0.3s; }
.stagger-animation > *:nth-child(4) { animation-delay: 0.4s; }
```

---

## 🔧 Loading & Error Components

### Loading Component
```tsx
export function AlkaproLibraryLoading() {
  return (
    <div className="alkapro-library-loading">
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
          <div className="grid lg:grid-cols-2 gap-12 items-center">
            <div className="space-y-6">
              <div className="h-6 bg-gray-300 rounded animate-pulse w-1/3" />
              <div className="h-10 bg-gray-300 rounded animate-pulse" />
              <div className="space-y-3">
                <div className="h-4 bg-gray-300 rounded animate-pulse" />
                <div className="h-4 bg-gray-300 rounded animate-pulse w-5/6" />
                <div className="h-4 bg-gray-300 rounded animate-pulse w-4/6" />
              </div>
            </div>
            <div className="h-64 bg-gray-300 rounded-2xl animate-pulse" />
          </div>
        </div>
      </div>
      
      {/* Features Loading */}
      <div className="py-16">
        <div className="container mx-auto px-4">
          <div className="text-center mb-16">
            <div className="h-10 bg-gray-300 rounded animate-pulse mx-auto w-1/2 mb-6" />
          </div>
          <div className="grid md:grid-cols-2 gap-12">
            {[1, 2].map((i) => (
              <div key={i} className="space-y-6">
                <div className="h-8 bg-gray-300 rounded animate-pulse w-1/2" />
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
interface AlkaproLibraryErrorProps {
  error?: string
  onRetry?: () => void
}

export function AlkaproLibraryError({ error, onRetry }: AlkaproLibraryErrorProps) {
  return (
    <div className="py-24 bg-gray-50">
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
              className="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors"
            >
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

## 📱 Responsive Design

### Mobile Optimizations
```tsx
// Mobile-first responsive breakpoints
const breakpoints = {
  sm: '640px',   // Small devices
  md: '768px',   // Medium devices  
  lg: '1024px',  // Large devices
  xl: '1280px',  // Extra large devices
  '2xl': '1536px' // 2X Extra large devices
}

// Mobile-optimized hero section
export function AlkaproHeroMobile({ data }: AlkaproHeroProps) {
  return (
    <section className="alkapro-hero px-4 py-12 sm:py-16 lg:py-24">
      <div className="container mx-auto">
        <div className="text-center lg:text-left lg:grid lg:grid-cols-2 lg:gap-12 lg:items-center">
          <div className="text-white space-y-4 lg:space-y-6">
            <h1 className="text-2xl sm:text-3xl lg:text-6xl font-bold leading-tight">
              {data.title}
            </h1>
            <p className="text-base sm:text-lg lg:text-2xl text-blue-100 leading-relaxed">
              {data.subtitle}
            </p>
            <div className="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center lg:justify-start">
              <button className="bg-white text-blue-600 px-6 py-3 lg:px-8 rounded-lg font-semibold hover:bg-blue-50 transition-colors">
                Jelajahi Koleksi
              </button>
              <button className="border-2 border-white text-white px-6 py-3 lg:px-8 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition-colors">
                Lihat Fasilitas
              </button>
            </div>
          </div>
          {data.image && (
            <div className="mt-8 lg:mt-0">
              <img 
                src={data.image} 
                alt={data.title}
                className="w-full h-auto rounded-2xl shadow-2xl"
              />
            </div>
          )}
        </div>
      </div>
    </section>
  )
}
```

### Touch-Friendly Components
```tsx
// Touch-optimized gallery for mobile
export function AlkaproGalleryMobile({ data }: AlkaproGalleryProps) {
  return (
    <Swiper
      modules={[Autoplay, Pagination]}
      spaceBetween={16}
      slidesPerView={1.2}
      centeredSlides={true}
      autoplay={data.auto_slide ? {
        delay: data.slide_interval,
        disableOnInteraction: false,
      } : false}
      pagination={{ 
        clickable: true,
        dynamicBullets: true 
      }}
      breakpoints={{
        640: { 
          slidesPerView: 2.2,
          centeredSlides: false 
        },
        1024: { 
          slidesPerView: 3,
          centeredSlides: false 
        },
      }}
      className="gallery-swiper-mobile"
    >
      {data.images.map((image, index) => (
        <SwiperSlide key={index}>
          <div className="relative group cursor-pointer">
            <img 
              src={image} 
              alt={`Gallery ${index + 1}`}
              className="w-full h-48 sm:h-64 object-cover rounded-xl shadow-lg"
            />
          </div>
        </SwiperSlide>
      ))}
    </Swiper>
  )
}
```

---

## 🚀 Performance Optimizations

### Image Optimization
```tsx
import { useState } from 'react'

interface OptimizedImageProps {
  src: string
  alt: string
  className?: string
  priority?: boolean
}

export function OptimizedImage({ src, alt, className, priority }: OptimizedImageProps) {
  const [isLoaded, setIsLoaded] = useState(false)
  const [hasError, setHasError] = useState(false)

  return (
    <div className={`relative overflow-hidden ${className}`}>
      {!isLoaded && !hasError && (
        <div className="absolute inset-0 bg-gray-200 animate-pulse" />
      )}
      
      {hasError ? (
        <div className="absolute inset-0 bg-gray-100 flex items-center justify-center">
          <svg className="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
          </svg>
        </div>
      ) : (
        <img
          src={src}
          alt={alt}
          loading={priority ? 'eager' : 'lazy'}
          className={`w-full h-full object-cover transition-opacity duration-300 ${
            isLoaded ? 'opacity-100' : 'opacity-0'
          }`}
          onLoad={() => setIsLoaded(true)}
          onError={() => setHasError(true)}
        />
      )}
    </div>
  )
}
```

### Lazy Loading Components
```tsx
import { lazy, Suspense } from 'react'

// Lazy load heavy components
const AlkaproGallerySection = lazy(() => import('./AlkaproGallerySection'))
const AlkaproProgramsSection = lazy(() => import('./AlkaproProgramsSection'))

export function AlkaproLibraryOptimized({ data }: AlkaproLibraryProps) {
  return (
    <div className="alkapro-library-section">
      {/* Always load hero and intro */}
      <AlkaproHeroSection data={data.hero_section} />
      <AlkaproIntroSection data={data.introduction} />
      <AlkaproFeaturesSection data={data.features} />
      
      {/* Lazy load gallery */}
      {data.gallery && (
        <Suspense fallback={<GalleryLoadingSkeleton />}>
          <AlkaproGallerySection data={data.gallery} title="Galeri Perpustakaan" />
        </Suspense>
      )}
      
      {/* Lazy load programs */}
      {data.programs && (
        <Suspense fallback={<ProgramsLoadingSkeleton />}>
          <AlkaproProgramsSection data={data.programs} />
        </Suspense>
      )}
      
      {/* Other sections... */}
    </div>
  )
}
```

---

## 🧪 Testing

### Unit Tests
```tsx
import { render, screen, waitFor } from '@testing-library/react'
import { AlkaproLibraryComponent } from './AlkaproLibraryComponent'

const mockData = {
  id: 1,
  basic_info: {
    title: 'Test Library',
    subtitle: 'Test Subtitle',
    banner_desktop: null,
    banner_mobile: null,
  },
  hero_section: {
    title: 'Test Hero',
    subtitle: 'Test Hero Subtitle',
    image: null,
  },
  // ... other mock data
}

describe('AlkaproLibraryComponent', () => {
  test('renders hero section correctly', () => {
    render(<AlkaproLibraryComponent data={mockData} />)
    
    expect(screen.getByText('Test Hero')).toBeInTheDocument()
    expect(screen.getByText('Test Hero Subtitle')).toBeInTheDocument()
  })

  test('conditionally renders gallery section', () => {
    const dataWithGallery = {
      ...mockData,
      gallery: {
        images: ['image1.jpg', 'image2.jpg'],
        auto_slide: true,
        slide_interval: 4000,
      }
    }
    
    render(<AlkaproLibraryComponent data={dataWithGallery} />)
    expect(screen.getByText('Galeri Perpustakaan')).toBeInTheDocument()
  })

  test('does not render gallery when not provided', () => {
    render(<AlkaproLibraryComponent data={mockData} />)
    expect(screen.queryByText('Galeri Perpustakaan')).not.toBeInTheDocument()
  })
})
```

### Integration Tests
```tsx
import { render, screen, waitFor } from '@testing-library/react'
import { useAlkaproLibrary } from './useAlkaproLibrary'

// Mock fetch
global.fetch = jest.fn()

describe('useAlkaproLibrary hook', () => {
  beforeEach(() => {
    (fetch as jest.Mock).mockClear()
  })

  test('fetches data successfully', async () => {
    const mockResponse = {
      success: true,
      data: mockData
    }
    
    ;(fetch as jest.Mock).mockResolvedValueOnce({
      json: async () => mockResponse
    })

    const { result } = renderHook(() => useAlkaproLibrary())

    await waitFor(() => {
      expect(result.current.loading).toBe(false)
    })

    expect(result.current.data).toEqual(mockData)
    expect(result.current.error).toBeNull()
  })

  test('handles fetch error', async () => {
    ;(fetch as jest.Mock).mockRejectedValueOnce(new Error('API Error'))

    const { result } = renderHook(() => useAlkaproLibrary())

    await waitFor(() => {
      expect(result.current.loading).toBe(false)
    })

    expect(result.current.data).toBeNull()
    expect(result.current.error).toBe('API Error')
  })
})
```

---

## 📚 Usage Examples

### Basic Page Implementation
```tsx
// pages/perpustakaan.tsx
import { AlkaproLibrarySection } from '@/components/AlkaproLibrarySection'

export default function PerpustakaanPage() {
  return (
    <div className="min-h-screen">
      <AlkaproLibrarySection />
    </div>
  )
}
```

### With Custom Styling
```tsx
// Custom styled implementation
export function CustomAlkaproLibrary() {
  const { data, loading, error } = useAlkaproLibrary()

  if (loading) return <AlkaproLibraryLoading />
  if (error) return <AlkaproLibraryError error={error} />
  if (!data) return null

  return (
    <div className="custom-library-wrapper">
      <AlkaproLibraryComponent 
        data={data} 
        className="custom-library-styles"
      />
    </div>
  )
}
```

### With Analytics
```tsx
import { useEffect } from 'react'
import { trackEvent } from '@/utils/analytics'

export function AlkaproLibraryWithAnalytics() {
  const { data, loading } = useAlkaproLibrary()

  useEffect(() => {
    if (data) {
      trackEvent('alkapro_library_viewed', {
        library_id: data.id,
        sections_visible: {
          gallery: !!data.gallery,
          programs: !!data.programs,
          services: !!data.additional_services,
        }
      })
    }
  }, [data])

  // Component implementation...
}
```

---

## 🔧 Troubleshooting

### Common Issues

#### 1. Images Not Loading
```tsx
// Check image URLs and add fallbacks
const getImageUrl = (url: string | null) => {
  if (!url) return '/images/placeholder-library.jpg'
  
  // Handle relative URLs
  if (url.startsWith('/')) {
    return `${process.env.NEXT_PUBLIC_API_BASE_URL}${url}`
  }
  
  return url
}
```

#### 2. API Connection Issues
```tsx
// Add retry logic
const fetchWithRetry = async (url: string, retries = 3) => {
  for (let i = 0; i < retries; i++) {
    try {
      const response = await fetch(url)
      if (response.ok) return response
      throw new Error(`HTTP ${response.status}`)
    } catch (error) {
      if (i === retries - 1) throw error
      await new Promise(resolve => setTimeout(resolve, 1000 * (i + 1)))
    }
  }
}
```

#### 3. Swiper Not Working
```tsx
// Ensure Swiper CSS is imported
import 'swiper/css'
import 'swiper/css/pagination'
import 'swiper/css/navigation'
import 'swiper/css/autoplay'

// Check if modules are properly imported
import { Swiper, SwiperSlide } from 'swiper/react'
import { Autoplay, Pagination, Navigation } from 'swiper/modules'
```

---

## 📈 SEO Optimization

### Meta Tags Implementation
```tsx
import Head from 'next/head'

export function AlkaproLibrarySEO({ data }: { data: AlkaproLibraryData }) {
  return (
    <Head>
      <title>{data.seo.meta_title}</title>
      <meta name="description" content={data.seo.meta_description} />
      <meta name="keywords" content={data.seo.meta_keywords} />
      
      {/* Open Graph */}
      <meta property="og:title" content={data.seo.meta_title} />
      <meta property="og:description" content={data.seo.meta_description} />
      <meta property="og:image" content={data.hero_section.image || '/images/library-og.jpg'} />
      <meta property="og:type" content="website" />
      
      {/* Twitter Card */}
      <meta name="twitter:card" content="summary_large_image" />
      <meta name="twitter:title" content={data.seo.meta_title} />
      <meta name="twitter:description" content={data.seo.meta_description} />
      <meta name="twitter:image" content={data.hero_section.image || '/images/library-og.jpg'} />
      
      {/* Structured Data */}
      <script
        type="application/ld+json"
        dangerouslySetInnerHTML={{
          __html: JSON.stringify({
            "@context": "https://schema.org",
            "@type": "Library",
            "name": data.basic_info.title,
            "description": data.seo.meta_description,
            "image": data.hero_section.image,
            "address": {
              "@type": "PostalAddress",
              "addressLocality": "Kartasura",
              "addressRegion": "Jawa Tengah",
              "addressCountry": "ID"
            }
          })
        }}
      />
    </Head>
  )
}
```

---

## 🚀 Deployment Checklist

### Pre-deployment
- [ ] All TypeScript interfaces defined
- [ ] Error handling implemented
- [ ] Loading states added
- [ ] Responsive design tested
- [ ] Images optimized
- [ ] SEO meta tags configured
- [ ] Analytics tracking added
- [ ] Performance optimized

### Post-deployment
- [ ] API endpoints working
- [ ] Images loading correctly
- [ ] Mobile responsiveness verified
- [ ] Cross-browser compatibility tested
- [ ] Performance metrics checked
- [ ] SEO validation completed

---

## 📞 Support & Maintenance

### API Endpoints Status
- **Complete Data**: `/api/v1/alkapro-library/complete`
- **Settings Only**: `/api/v1/alkapro-library/settings`
- **Gallery Only**: `/api/v1/alkapro-library/gallery`
- **Pamphlets Only**: `/api/v1/alkapro-library/pamphlets`

### Backend Dependencies
- Laravel 10+
- Filament Admin Panel
- MySQL/PostgreSQL Database
- Storage for file uploads

### Frontend Dependencies
```json
{
  "dependencies": {
    "react": "^18.0.0",
    "next": "^13.0.0",
    "swiper": "^10.0.0",
    "tailwindcss": "^3.0.0"
  },
  "devDependencies": {
    "@types/react": "^18.0.0",
    "typescript": "^5.0.0"
  }
}
```

---

## 🎯 Conclusion

Dokumentasi ini menyediakan panduan lengkap untuk implementasi frontend Alkapro Library dengan:

✅ **Complete TypeScript interfaces**
✅ **Responsive React components**  
✅ **Performance optimizations**
✅ **Error handling & loading states**
✅ **SEO optimization**
✅ **Testing guidelines**
✅ **Deployment checklist**

Untuk pertanyaan atau dukungan teknis, silakan hubungi tim development atau buat issue di repository project.

---

*Dokumentasi ini dibuat untuk memastikan implementasi frontend Alkapro Library yang konsisten, performant, dan user-friendly.*

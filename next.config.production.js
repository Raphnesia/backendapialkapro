/** @type {import('next').NextConfig} */
const nextConfig = {
  // Production Configuration
  env: {
<<<<<<< HEAD
    NEXT_PUBLIC_API_URL: 'https://api.alkapro.id',
    NEXT_PUBLIC_APP_URL: 'https://alkapro.id',
    NEXT_PUBLIC_STORAGE_URL: 'https://api.alkapro.id/storage',
=======
    NEXT_PUBLIC_API_URL: 'https://api.raphnesia.my.id',
    NEXT_PUBLIC_APP_URL: 'https://raphnesia.my.id',
    NEXT_PUBLIC_STORAGE_URL: 'https://api.raphnesia.my.id/storage',
>>>>>>> 01cf9e1bd0b1c9f8e46d93c6fdb38a4008df2eeb
  },
  
  // Image domains for production
  images: {
<<<<<<< HEAD
    domains: ['api.alkapro.id', 'alkapro.id'],
    remotePatterns: [
      {
        protocol: 'https',
        hostname: 'api.alkapro.id',
=======
    domains: ['api.raphnesia.my.id', 'raphnesia.my.id'],
    remotePatterns: [
      {
        protocol: 'https',
        hostname: 'api.raphnesia.my.id',
>>>>>>> 01cf9e1bd0b1c9f8e46d93c6fdb38a4008df2eeb
        port: '',
        pathname: '/storage/**',
      },
      {
        protocol: 'https',
<<<<<<< HEAD
        hostname: 'alkapro.id',
=======
        hostname: 'raphnesia.my.id',
>>>>>>> 01cf9e1bd0b1c9f8e46d93c6fdb38a4008df2eeb
        port: '',
        pathname: '/**',
      },
    ],
  },
  
  // Production optimizations
  compress: true,
  poweredByHeader: false,
  generateEtags: false,
  
  // Security headers
  async headers() {
    return [
      {
        source: '/(.*)',
        headers: [
          {
            key: 'X-Frame-Options',
            value: 'DENY',
          },
          {
            key: 'X-Content-Type-Options',
            value: 'nosniff',
          },
          {
            key: 'Referrer-Policy',
            value: 'origin-when-cross-origin',
          },
        ],
      },
    ];
  },
  
  // Redirects for production
  async redirects() {
    return [
      {
        source: '/api/:path*',
<<<<<<< HEAD
        destination: 'https://api.alkapro.id/api/:path*',
=======
        destination: 'https://api.raphnesia.my.id/api/:path*',
>>>>>>> 01cf9e1bd0b1c9f8e46d93c6fdb38a4008df2eeb
        permanent: true,
      },
    ];
  },
};

module.exports = nextConfig;

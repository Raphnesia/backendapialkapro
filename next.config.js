/** @type {import('next').NextConfig} */
const nextConfig = {
  // Environment-based configuration
  env: {
    NEXT_PUBLIC_API_URL: process.env.NODE_ENV === 'production' 
<<<<<<< HEAD
      ? 'https://api.alkapro.id' 
      : 'http://localhost:8000',
    NEXT_PUBLIC_APP_URL: process.env.NODE_ENV === 'production' 
      ? 'https://alkapro.id' 
      : 'http://localhost:3000',
    NEXT_PUBLIC_STORAGE_URL: process.env.NODE_ENV === 'production' 
      ? 'https://api.alkapro.id/storage' 
=======
      ? 'https://api.raphnesia.my.id' 
      : 'http://localhost:8000',
    NEXT_PUBLIC_APP_URL: process.env.NODE_ENV === 'production' 
      ? 'https://raphnesia.my.id' 
      : 'http://localhost:3000',
    NEXT_PUBLIC_STORAGE_URL: process.env.NODE_ENV === 'production' 
      ? 'https://api.raphnesia.my.id/storage' 
>>>>>>> 01cf9e1bd0b1c9f8e46d93c6fdb38a4008df2eeb
      : 'http://localhost:8000/storage',
  },
  
  // Image configuration
  images: {
    domains: process.env.NODE_ENV === 'production' 
<<<<<<< HEAD
      ? ['api.alkapro.id', 'alkapro.id']
=======
      ? ['api.raphnesia.my.id', 'raphnesia.my.id']
>>>>>>> 01cf9e1bd0b1c9f8e46d93c6fdb38a4008df2eeb
      : ['localhost'],
    remotePatterns: [
      {
        protocol: process.env.NODE_ENV === 'production' ? 'https' : 'http',
<<<<<<< HEAD
        hostname: process.env.NODE_ENV === 'production' ? 'api.alkapro.id' : 'localhost',
=======
        hostname: process.env.NODE_ENV === 'production' ? 'api.raphnesia.my.id' : 'localhost',
>>>>>>> 01cf9e1bd0b1c9f8e46d93c6fdb38a4008df2eeb
        port: process.env.NODE_ENV === 'production' ? '' : '8000',
        pathname: '/storage/**',
      },
      {
        protocol: process.env.NODE_ENV === 'production' ? 'https' : 'http',
<<<<<<< HEAD
        hostname: process.env.NODE_ENV === 'production' ? 'alkapro.id' : 'localhost',
=======
        hostname: process.env.NODE_ENV === 'production' ? 'raphnesia.my.id' : 'localhost',
>>>>>>> 01cf9e1bd0b1c9f8e46d93c6fdb38a4008df2eeb
        port: process.env.NODE_ENV === 'production' ? '' : '3000',
        pathname: '/**',
      },
    ],
  },
  
  // Development optimizations
  ...(process.env.NODE_ENV === 'development' && {
    reactStrictMode: true,
    swcMinify: false,
  }),
  
  // Production optimizations
  ...(process.env.NODE_ENV === 'production' && {
    compress: true,
    poweredByHeader: false,
    generateEtags: false,
  }),
  
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
  
  // API redirects for production
  async redirects() {
    if (process.env.NODE_ENV === 'production') {
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
    }
    return [];
  },
  
  // Storage rewrites for production
  async rewrites() {
    if (process.env.NODE_ENV === 'production') {
      return [
        {
          source: '/storage/:path*',
<<<<<<< HEAD
          destination: 'https://api.alkapro.id/storage/:path*',
=======
          destination: 'https://api.raphnesia.my.id/storage/:path*',
>>>>>>> 01cf9e1bd0b1c9f8e46d93c6fdb38a4008df2eeb
        },
      ];
    }
    return [];
  },
};

module.exports = nextConfig;

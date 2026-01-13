/** @type {import('next').NextConfig} */
const nextConfig = {
  // Environment-based configuration
  env: {
    NEXT_PUBLIC_API_URL: process.env.NODE_ENV === 'production' 
      ? 'https://api.alkapro.id' 
      : 'http://localhost:8000',
    NEXT_PUBLIC_APP_URL: process.env.NODE_ENV === 'production' 
      ? 'https://alkapro.id' 
      : 'http://localhost:3000',
    NEXT_PUBLIC_STORAGE_URL: process.env.NODE_ENV === 'production' 
      ? 'https://api.alkapro.id/storage' 
      : 'http://localhost:8000/storage',
  },
  
  // Image configuration
  images: {
    domains: process.env.NODE_ENV === 'production' 
      ? ['api.alkapro.id', 'alkapro.id']
      : ['localhost'],
    remotePatterns: [
      {
        protocol: process.env.NODE_ENV === 'production' ? 'https' : 'http',
        hostname: process.env.NODE_ENV === 'production' ? 'api.alkapro.id' : 'localhost',
        port: process.env.NODE_ENV === 'production' ? '' : '8000',
        pathname: '/storage/**',
      },
      {
        protocol: process.env.NODE_ENV === 'production' ? 'https' : 'http',
        hostname: process.env.NODE_ENV === 'production' ? 'alkapro.id' : 'localhost',
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
          destination: 'https://api.alkapro.id/api/:path*',
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
          destination: 'https://api.alkapro.id/storage/:path*',
        },
      ];
    }
    return [];
  },
};

module.exports = nextConfig;

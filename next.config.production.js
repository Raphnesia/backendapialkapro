/** @type {import('next').NextConfig} */
const nextConfig = {
  // Production Configuration
  env: {
    NEXT_PUBLIC_API_URL: 'https://api.alkapro.id',
    NEXT_PUBLIC_APP_URL: 'https://alkapro.id',
    NEXT_PUBLIC_STORAGE_URL: 'https://api.alkapro.id/storage',
  },
  
  // Image domains for production
  images: {
    domains: ['api.alkapro.id', 'alkapro.id'],
    remotePatterns: [
      {
        protocol: 'https',
        hostname: 'api.alkapro.id',
        port: '',
        pathname: '/storage/**',
      },
      {
        protocol: 'https',
        hostname: 'alkapro.id',
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
        destination: 'https://api.alkapro.id/api/:path*',
        permanent: true,
      },
    ];
  },
};

module.exports = nextConfig;

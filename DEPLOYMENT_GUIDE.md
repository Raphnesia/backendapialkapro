# 🚀 **Panduan Deployment Lengkap**

## 📋 **Overview**
- **Frontend (Next.js)**: Deploy ke Vercel dengan domain `alkapro.id`
- **Backend (Laravel)**: Deploy ke hosting dengan subdomain `api.alkapro.id`

---

## 🌐 **FRONTEND - Next.js ke Vercel**

### **Step 1: Setup Vercel Project**
```bash
# Install Vercel CLI
npm i -g vercel

# Login ke Vercel
vercel login

# Deploy project
vercel --prod
```

### **Step 2: Konfigurasi Domain**
1. **Buka Vercel Dashboard** → Project Settings → Domains
2. **Add Domain**: `alkapro.id`
3. **Verifikasi DNS** dengan menambahkan record:
   ```
   Type: CNAME
   Name: @
   Value: cname.vercel-dns.com
   ```

### **Step 3: Environment Variables di Vercel**
Buka **Project Settings** → **Environment Variables**:
```
NEXT_PUBLIC_API_URL=https://api.alkapro.id
NEXT_PUBLIC_APP_URL=https://alkapro.id
NEXT_PUBLIC_STORAGE_URL=https://api.alkapro.id/storage
```

### **Step 4: Build & Deploy**
```bash
# Build untuk production
npm run build

# Deploy ke Vercel
vercel --prod
```

---

## 🖥️ **BACKEND - Laravel ke Hosting**

### **Step 1: Setup Subdomain**
1. **Buka cPanel** → **Subdomains**
2. **Create Subdomain**:
   - Subdomain: `api`
   - Domain: `alkapro.id`
   - Document Root: `public_html/api`

### **Step 2: Upload Laravel Files**
1. **Upload semua file Laravel** ke folder `public_html/api/`
2. **Pastikan struktur folder**:
   ```
   public_html/api/
   ├── app/
   ├── bootstrap/
   ├── config/
   ├── database/
   ├── public/
   ├── resources/
   ├── routes/
   ├── storage/
   └── vendor/
   ```

### **Step 3: Konfigurasi .env Production**
Buat file `.env` di root Laravel dengan isi:
```env
APP_NAME="SMP Al Kautsar API"
APP_ENV=production
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=false
APP_URL=https://api.alkapro.id

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=YOUR_DATABASE_NAME
DB_USERNAME=YOUR_DATABASE_USER
DB_PASSWORD=YOUR_DATABASE_PASSWORD

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=public
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_APP_NAME="${APP_NAME}"
VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```

### **Step 4: Setup Database**
1. **Buat database baru** di cPanel → MySQL Databases
2. **Import database** dari local development
3. **Update .env** dengan kredensial database

### **Step 5: File Permissions**
```bash
# Set permissions untuk storage dan cache
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/

# Set ownership
chown -R www-data:www-data storage/
chown -R www-data:www-data bootstrap/cache/
```

### **Step 6: Generate App Key**
```bash
# Generate application key
php artisan key:generate

# Clear semua cache
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Optimize untuk production
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### **Step 7: Storage Link**
```bash
# Buat symbolic link untuk storage
php artisan storage:link
```

---

## 🔧 **KONFIGURASI CORS & SECURITY**

### **Update config/cors.php**
```php
<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie'],
    'allowed_methods' => ['*'],
    'allowed_origins' => [
        'http://localhost:3000',           // Development
        'https://alkapro.id',         // Production Frontend
        'https://*.vercel.app',            // Vercel preview
    ],
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,
];
```

### **Update .htaccess untuk Apache**
```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]

    # Security Headers
    Header always set X-Frame-Options DENY
    Header always set X-Content-Type-Options nosniff
    Header always set X-XSS-Protection "1; mode=block"
    Header always set Referrer-Policy "strict-origin-when-cross-origin"
</IfModule>

# Enable CORS
<IfModule mod_headers.c>
    Header always set Access-Control-Allow-Origin "*"
    Header always set Access-Control-Allow-Methods "GET, POST, PUT, DELETE, OPTIONS"
    Header always set Access-Control-Allow-Headers "Content-Type, Authorization, X-Requested-With"
</IfModule>
```

---

## 🧪 **TESTING DEPLOYMENT**

### **Test Frontend**
```bash
# Test API connection
curl https://alkapro.id/api/info-ppdb/settings

# Test image loading
curl https://alkapro.id/storage/ppdb/banners/test.jpg
```

### **Test Backend**
```bash
# Test API endpoint
curl https://api.alkapro.id/api/info-ppdb/settings

# Test storage
curl https://api.alkapro.id/storage/ppdb/banners/test.jpg
```

---

## 🚨 **TROUBLESHOOTING**

### **Masalah Umum**
1. **CORS Error**: Pastikan `config/cors.php` sudah benar
2. **Image 403**: Pastikan `storage:link` sudah dibuat
3. **Database Error**: Cek kredensial database di `.env`
4. **500 Error**: Cek error log di `storage/logs/laravel.log`

### **Debug Mode**
```env
# Untuk debugging sementara
APP_DEBUG=true
APP_ENV=production
```

---

## 📱 **VERCEL MOBILE APP (Optional)**

### **Install Vercel Mobile App**
1. **Download Vercel App** dari App Store/Play Store
2. **Login** dengan akun Vercel
3. **Monitor deployment** secara real-time
4. **Rollback** jika ada masalah

---

## 🔄 **AUTOMATIC DEPLOYMENT**

### **Setup GitHub Actions (Optional)**
```yaml
# .github/workflows/deploy.yml
name: Deploy to Vercel
on:
  push:
    branches: [main]
jobs:
  deploy:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v2
      - uses: amondnet/vercel-action@v20
        with:
          vercel-token: ${{ secrets.VERCEL_TOKEN }}
          vercel-org-id: ${{ secrets.ORG_ID }}
          vercel-project-id: ${{ secrets.PROJECT_ID }}
          vercel-args: '--prod'
```

---

## 📞 **SUPPORT**

Jika ada masalah:
1. **Cek error log** Laravel di `storage/logs/`
2. **Cek Vercel logs** di dashboard
3. **Test API** dengan Postman/Insomnia
4. **Cek DNS propagation** dengan tools online

---

**🎯 Target: Frontend di `alkapro.id`, Backend di `api.alkapro.id`**

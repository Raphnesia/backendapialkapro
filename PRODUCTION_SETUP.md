# 🚀 **PRODUCTION SETUP CHECKLIST - Laravel Backend**

## 📋 **SEBELUM UPLOAD LARAVEL FILES**

### **1. Konfigurasi File yang Sudah Diupdate ✅**
- [x] `config/cors.php` - CORS untuk production
- [x] `config/app.php` - App configuration
- [x] `config/session.php` - Session untuk subdomain
- [x] `config/filesystems.php` - Storage configuration
- [x] `app/Providers/AppServiceProvider.php` - HTTPS force

### **2. File yang Perlu Dibuat Manual**
- [ ] `.env.production` - Environment variables production
- [ ] `.htaccess` - Apache configuration untuk subdomain

---

## 🔧 **KONFIGURASI YANG PERLU DISIAPKAN**

### **A. Environment Variables (.env.production)**
```env
APP_NAME="SMP Al Kautsar API"
APP_ENV=production
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=false
<<<<<<< HEAD
APP_URL=https://api.alkapro.id
=======
APP_URL=https://api.raphnesia.my.id
>>>>>>> 01cf9e1bd0b1c9f8e46d93c6fdb38a4008df2eeb

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=YOUR_DATABASE_NAME
DB_USERNAME=YOUR_DATABASE_USER
DB_PASSWORD=YOUR_DATABASE_PASSWORD

<<<<<<< HEAD
SESSION_DOMAIN=.alkapro.id
SESSION_SECURE_COOKIE=true

CORS_ALLOWED_ORIGINS=https://alkapro.id,https://*.vercel.app
=======
SESSION_DOMAIN=.raphnesia.my.id
SESSION_SECURE_COOKIE=true

CORS_ALLOWED_ORIGINS=https://raphnesia.my.id,https://*.vercel.app
>>>>>>> 01cf9e1bd0b1c9f8e46d93c6fdb38a4008df2eeb
```

### **B. .htaccess untuk Subdomain**
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

## 🗂️ **STRUKTUR FOLDER SETELAH UPLOAD**

```
public_html/api/                    # Root Laravel
├── app/                           # Application logic
├── bootstrap/                     # Bootstrap files
├── config/                        # Configuration files
├── database/                      # Database files
├── public/                        # Public web root
│   ├── .htaccess                 # Apache config
│   ├── index.php                 # Entry point
│   └── storage -> ../storage     # Storage symlink
├── resources/                     # Views, assets
├── routes/                        # Route definitions
├── storage/                       # File storage
│   ├── app/                      # App storage
│   │   └── public/              # Public files
│   └── logs/                     # Log files
├── vendor/                        # Composer packages
├── .env                          # Production environment
└── artisan                       # Artisan CLI
```

---

## ⚙️ **COMMANDS YANG PERLU DIJALANKAN SETELAH UPLOAD**

### **1. Setup Dasar**
```bash
# Generate application key
php artisan key:generate

# Clear semua cache
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

### **2. Database Setup**
```bash
# Run migrations
php artisan migrate

# Seed data (jika ada)
php artisan db:seed

# Check migration status
php artisan migrate:status
```

### **3. Storage Setup**
```bash
# Buat symbolic link untuk storage
php artisan storage:link

# Set permissions
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/
```

### **4. Production Optimization**
```bash
# Cache semua yang bisa di-cache
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Optimize autoloader
composer install --optimize-autoloader --no-dev
```

---

## 🔍 **VERIFIKASI SETUP**

### **1. Test API Endpoints**
```bash
# Test Info PPDB API
<<<<<<< HEAD
curl https://api.alkapro.id/api/info-ppdb/settings

# Test Profil API
curl https://api.alkapro.id/api/profil/settings

# Test Program Khusus API
curl https://api.alkapro.id/api/program-khusus
=======
curl https://api.raphnesia.my.id/api/info-ppdb/settings

# Test Profil API
curl https://api.raphnesia.my.id/api/profil/settings

# Test Program Khusus API
curl https://api.raphnesia.my.id/api/program-khusus
>>>>>>> 01cf9e1bd0b1c9f8e46d93c6fdb38a4008df2eeb
```

### **2. Test File Storage**
```bash
# Test storage access
<<<<<<< HEAD
curl https://api.alkapro.id/storage/ppdb/banners/test.jpg

# Test admin panel
curl https://api.alkapro.id/admin
=======
curl https://api.raphnesia.my.id/storage/ppdb/banners/test.jpg

# Test admin panel
curl https://api.raphnesia.my.id/admin
>>>>>>> 01cf9e1bd0b1c9f8e46d93c6fdb38a4008df2eeb
```

### **3. Test CORS**
```bash
# Test dari frontend domain
<<<<<<< HEAD
curl -H "Origin: https://alkapro.id" \
     -H "Access-Control-Request-Method: GET" \
     -H "Access-Control-Request-Headers: X-Requested-With" \
     -X OPTIONS \
     https://api.alkapro.id/api/info-ppdb/settings
=======
curl -H "Origin: https://raphnesia.my.id" \
     -H "Access-Control-Request-Method: GET" \
     -H "Access-Control-Request-Headers: X-Requested-With" \
     -X OPTIONS \
     https://api.raphnesia.my.id/api/info-ppdb/settings
>>>>>>> 01cf9e1bd0b1c9f8e46d93c6fdb38a4008df2eeb
```

---

## 🚨 **TROUBLESHOOTING COMMON ISSUES**

### **1. 500 Internal Server Error**
```bash
# Check error logs
tail -f storage/logs/laravel.log

# Check permissions
ls -la storage/
ls -la bootstrap/cache/
```

### **2. CORS Error**
```bash
# Verify CORS config
php artisan config:show cors

# Check allowed origins
grep -r "allowed_origins" config/
```

### **3. Image 403 Forbidden**
```bash
# Check storage link
ls -la public/storage

# Recreate storage link
php artisan storage:link

# Check file permissions
chmod -R 755 storage/app/public/
```

### **4. Database Connection Error**
```bash
# Test database connection
php artisan tinker
DB::connection()->getPdo();

# Check .env file
cat .env | grep DB_
```

---

## 📱 **ADMIN PANEL ACCESS**

### **URL Admin Panel**
```
<<<<<<< HEAD
https://api.alkapro.id/admin
=======
https://api.raphnesia.my.id/admin
>>>>>>> 01cf9e1bd0b1c9f8e46d93c6fdb38a4008df2eeb
```

### **Default Credentials**
```
<<<<<<< HEAD
Email: admin@alkapro.id
=======
Email: admin@raphnesia.my.id
>>>>>>> 01cf9e1bd0b1c9f8e46d93c6fdb38a4008df2eeb
Password: (sesuai yang di-set di seeder)
```

---

## 🔒 **SECURITY CHECKLIST**

- [ ] `APP_DEBUG=false`
- [ ] `APP_ENV=production`
- [ ] HTTPS enabled
- [ ] CORS properly configured
- [ ] File permissions set correctly
- [ ] Storage symlink created
- [ ] All caches cleared and rebuilt
- [ ] Database credentials secure
- [ ] Error logging enabled

---

## 🎯 **TARGET DEPLOYMENT**

<<<<<<< HEAD
**Frontend**: `https://alkapro.id` (Vercel)  
**Backend**: `https://api.alkapro.id` (Hosting)  
**Admin Panel**: `https://api.alkapro.id/admin`  
**API Base**: `https://api.alkapro.id/api/*`  
=======
**Frontend**: `https://raphnesia.my.id` (Vercel)  
**Backend**: `https://api.raphnesia.my.id` (Hosting)  
**Admin Panel**: `https://api.raphnesia.my.id/admin`  
**API Base**: `https://api.raphnesia.my.id/api/*`  
>>>>>>> 01cf9e1bd0b1c9f8e46d93c6fdb38a4008df2eeb

---

**📝 Catatan: Semua konfigurasi ini harus disiapkan SEBELUM upload Laravel files ke hosting!**

# Laravel Backend Setup Guide

## Prerequisites
- PHP 8.1 or higher
- Composer
- MySQL or SQLite
- Laravel 11.x

## Installation Steps

### 1. Environment Configuration
Copy `.env.example` to `.env` and configure:

```bash
cp .env.example .env
```

Update the following in `.env`:
```env
APP_NAME="School Website Backend"
APP_URL=http://localhost:8000

# Database Configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=school_website
DB_USERNAME=root
DB_PASSWORD=

# CORS Configuration (for Next.js frontend)
CORS_ALLOWED_ORIGINS=http://localhost:3000,http://127.0.0.1:3000
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Generate Application Key
```bash
php artisan key:generate
```

### 4. Run Database Migrations
```bash
php artisan migrate
```

### 5. Create Storage Link
```bash
php artisan storage:link
```

### 6. Start Development Server
```bash
php artisan serve
```

## API Endpoints

### Base URL
- Local: `http://localhost:8000/api/v1`
- Production: `https://your-domain.com/api/v1`

### Available Endpoints

#### Home Sections
- `GET /api/v1/home-sections` - Get all home sections
- `GET /api/v1/home-sections/{id}` - Get specific home section

#### Teachers & Staff
- `GET /api/v1/teachers` - Get all teachers and staff
- `GET /api/v1/teachers/list` - Get only teachers
- `GET /api/v1/staff/list` - Get only staff

#### Posts (News & Articles)
- `GET /api/v1/posts` - Get all published posts
- `GET /api/v1/news` - Get only news posts
- `GET /api/v1/articles` - Get only article posts
- `GET /api/v1/posts/{slug}` - Get specific post by slug

#### Profile Sections
- `GET /api/v1/profile-sections` - Get all profile sections
- `GET /api/v1/profile-sections/{slug}` - Get specific profile section

#### Facilities
- `GET /api/v1/facilities` - Get all facilities
- `GET /api/v1/facilities/{slug}` - Get specific facility

#### School Activities
- `GET /api/v1/activities` - Get all activities
- `GET /api/v1/activities/{slug}` - Get specific activity

#### Health Check
- `GET /api/v1/health` - API health check

## Testing the API

You can test the API endpoints using:
1. Browser: Visit `http://localhost:8000/api/v1/health`
2. Postman/Curl: Test all endpoints
3. Frontend: Update your Next.js `.env.local` file

## Next Steps

1. Set up Filament Admin Panel (optional)
2. Add sample data
3. Configure production database
4. Set up file storage (S3, etc.)
5. Configure SSL certificates
6. Set up monitoring and logging

## Troubleshooting

### Common Issues

1. **CORS Issues**: Ensure CORS is configured correctly in `config/cors.php`
2. **Database Connection**: Check `.env` database settings
3. **Storage Issues**: Ensure `storage/app/public` is writable
4. **Migration Errors**: Check database permissions

### Debug Commands
```bash
php artisan route:list
php artisan config:clear
php artisan cache:clear
php artisan config:cache
```
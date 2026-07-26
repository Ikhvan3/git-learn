# Deployment Architecture

## Application

- Name: GitLearn
- Framework: Laravel 11.55.0
- PHP: 8.3.14
- Composer: 2.7.7
- Node.js: 22.20.0
- npm: 10.8.2
- Database: MySQL — verifikasi melalui `php artisan config:show database`
- Frontend builder: Vite — verifikasi melalui `vite.config.js`
- Repository: GitHub — isi berdasarkan `git remote get-url origin`

## Local Environment

- Operating system: Windows
- Development environment: Laragon
- Web server: Apache / Nginx — verifikasi melalui konfigurasi Laragon
- Local URL: `http://localhost`
- Laravel environment: `local`
- Debug mode: enabled
- Database: development database — isi nama tanpa password
- Project directory: `C:\laragon\www\gitlearn`
- Expected document root: `C:\laragon\www\gitlearn\public`

## Production Target

- Domain: To be determined
- Server type: To be determined
- Operating system: To be determined
- Web server: Apache or Nginx
- PHP version: 8.3 or compatible version
- Production database: Separate MySQL production database
- Document root: `/path/to/gitlearn/public`
- Environment: `production`
- Debug mode: disabled
- HTTPS: required

## Request Flow

Browser
→ DNS
→ Production server
→ Apache / Nginx
→ `public/index.php`
→ Laravel route and middleware
→ Controller and model
→ MySQL database
→ HTML or JSON response

## Required Deployment Steps

1. Verify automated tests have passed.
2. Back up the current application and database.
3. Pull or upload the source code.
4. Install PHP dependencies with Composer.
5. Configure the production environment.
6. Install and build frontend dependencies.
7. Run database migrations.
8. Create the public storage link.
9. Configure directory permissions.
10. Optimize the Laravel application.
11. Test the health route.
12. Test critical business features.
13. Verify application logs.
14. Prepare a rollback procedure.

## Production Commands

```bash
composer install --no-dev --prefer-dist --optimize-autoloader \
  --no-interaction

npm ci
npm run build

php artisan migrate --force
php artisan storage:link
php artisan optimize
```

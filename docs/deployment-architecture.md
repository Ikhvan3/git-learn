# Deployment Architecture

## Application

- Name: GitLearn
- Framework: Laravel 11
- PHP:
- Database:
- Frontend builder:
- Repository:

## Local Environment

- Operating system: Windows
- Web server: Laragon Apache / Nginx
- Local URL:
- Database:
- Document root:

## Production Target

- Domain:
- Server type:
- Web server:
- PHP version:
- Production database:
- Document root: `/path/to/project/public`
- HTTPS: Required

## Request Flow

Browser
→ DNS
→ Server
→ Web Server
→ `public/index.php`
→ Laravel
→ Database
→ Response

## Required Deployment Steps

1. Pull or upload source code.
2. Install Composer dependencies.
3. Configure production environment.
4. Build frontend assets.
5. Run database migration.
6. Create storage link.
7. Set directory permissions.
8. Optimize Laravel.
9. Test health route.
10. Test business features.

## Sensitive Data

- `.env`
- Database credentials
- API keys
- Mail credentials
- Private keys

## Health Checks

- `/up`
- Homepage
- Database connection
- Category API
- File upload

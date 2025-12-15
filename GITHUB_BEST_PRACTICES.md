# Why These Files Are NOT on GitHub

## Security & Best Practices

### ❌ `.env` - Secrets/Passwords
- Contains sensitive information:
  - Database passwords
  - API keys
  - Application encryption keys
  - Email credentials
- **Risk**: If pushed to GitHub, anyone can see your secrets
- **Solution**: Each developer creates their own `.env` file from `.env.example`

### ❌ `/node_modules` - JavaScript Dependencies
- Size: **Can be 500MB+**
- Contains 1000s of files
- Generated from `package.json` + `package-lock.json`
- **Why not**: Wastes storage and bandwidth, causes merge conflicts
- **Solution**: Run `npm install` to regenerate from package.json

### ❌ `/vendor` - PHP Dependencies
- Size: **Can be 200MB+**
- Contains Laravel framework and all packages
- Generated from `composer.json` + `composer.lock`
- **Why not**: Wastes storage and bandwidth
- **Solution**: Run `composer install` to regenerate from composer.json

### ❌ `/storage` - Runtime Files
- Contains:
  - Uploaded files
  - Log files
  - Cache files
  - Session data
- Generated when the app runs
- **Why not**: Not part of source code, changes constantly
- **Solution**: Create /storage locally, git ignores it

### ❌ Database Files
- SQLite databases (.sqlite)
- Database dumps
- **Why not**: 
  - Contains data, not code
  - Each environment has different data
  - Changes constantly during development
- **Solution**: Use migrations to rebuild database schema

## What IS on GitHub

✅ **Source Code**
- Controllers, Models, Views
- Routes, Middleware
- Configuration templates

✅ **Configuration Templates**
- `.env.example` - Shows what variables are needed
- `config/` files - Application settings

✅ **Database Schemas**
- `database/migrations/` - Create tables
- `database/seeders/` - Populate test data

✅ **Dependencies Lists**
- `package.json` - Node.js dependencies
- `composer.json` - PHP dependencies
- `package-lock.json` - Exact versions
- `composer.lock` - Exact versions

## Setup for New Developers

When someone clones your repository, they run:

```bash
# 1. Install PHP dependencies
composer install

# 2. Install JavaScript dependencies
npm install

# 3. Create .env from template
copy .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Run database migrations
php artisan migrate

# 6. (Optional) Seed test data
php artisan db:seed
```

This keeps the repository small, secure, and portable! ✅

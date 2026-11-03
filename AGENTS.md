# AGENTS.md

## Commands
- **Test**: `composer test` or `php artisan test`
- **Lint / Code Style**: `vendor/bin/pint`
- **Dev Server**: `composer dev` (runs artisan serve, queue, pail, vite concurrently)
- **Database**: SQLite (`database/database.sqlite`), migrated via `php artisan migrate`

## Architecture & Conventions
- **Framework**: Laravel 12 (PHP ^8.2) with Vite for frontend assets.
- **Testing**: PHPUnit 11 (`phpunit.xml`).

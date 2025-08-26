# Copilot Instructions for school-app

## Project Overview
- This is a Laravel-based school management application with a modern frontend (likely using Vite, TypeScript, and Inertia.js).
- Major domains: Students, Teachers, Classes, Sections, Academics, Schools, Users.
- Backend logic is in `app/Http/Controllers`, models in `app/Models`, requests in `app/Http/Requests`, and middleware in `app/Http/Middleware`.
- Frontend code is in `resources/js` (TypeScript, Vue/React possible), with views in `resources/views` (Blade templates).

## Key Workflows
- **Build frontend:** `npm run build` (uses Vite, see `vite.config.ts`).
- **Dev frontend:** `npm run dev` (hot reload).
- **Run backend:** `php artisan serve` (Laravel dev server).
- **Run tests:** `php artisan test` or `vendor/bin/phpunit` (tests in `tests/`).
- **Database:** SQLite by default (`database/database.sqlite`). Migrations in `database/migrations`, seeders in `database/seeders`.

## Patterns & Conventions
- **Models:** Eloquent models in `app/Models` (e.g., `Student.php`, `Teacher.php`).
- **Controllers:** RESTful, grouped by domain in `app/Http/Controllers`.
- **Routes:** Defined in `routes/web.php` (web), `routes/auth.php` (auth), etc.
- **Frontend:** Organized by feature in `resources/js/pages`, shared logic in `resources/js/composables`.
- **Blade views:** Main layout in `resources/views/app.blade.php`.
- **Config:** All app config in `config/` (e.g., `config/app.php`, `config/auth.php`).
- **Testing:** Feature tests in `tests/Feature`, unit tests in `tests/Unit`.

## Integration Points
- **Inertia.js:** Bridges Laravel backend and JS frontend (see `config/inertia.php`).
- **Auth:** Laravel's built-in authentication, customized in `config/auth.php` and `routes/auth.php`.
- **External packages:** Managed via Composer (`composer.json`) and npm (`package.json`).

## Examples
- To add a new model: create in `app/Models`, migrate with `php artisan make:migration`, update controllers/routes.
- To add a frontend page: create in `resources/js/pages`, add route in `routes/web.php`, update Blade/inertia views.

## Tips for AI Agents
- Always check for domain-specific logic in `app/Models` and `app/Http/Controllers` before making changes.
- Use migrations and seeders for DB changes; never edit `database.sqlite` directly.
- Respect existing folder structure and naming conventions.
- For cross-component features, trace data flow from route → controller → model → view/frontend.

---

_If any section is unclear or missing, please provide feedback so this guide can be improved._

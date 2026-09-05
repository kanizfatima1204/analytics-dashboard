# Pulse Analytics — Laravel 12

A professional responsive Business Analytics Dashboard built with **Laravel 12**, Blade, vanilla JavaScript and Chart.js. It uses synthetic business data, but authentication and sessions are real.

## Working authentication
- Login page: `/login`
- Protected dashboard: `/dashboard`
- Logout: POST `/logout`
- Session regeneration after login
- Session invalidation + CSRF token regeneration after logout
- Demo account: `admin@example.com` / `password`
- Unauthenticated users are redirected to `/login`

## Dashboard features
- Revenue, Users, Orders, Conversion Rate
- 7 / 30 / 90 / 12-month date filter
- Filter changes KPI + chart + funnel values
- Revenue & order chart
- Traffic channel doughnut chart
- Conversion funnel
- New users chart
- Search + sorting on transactions
- Responsive sidebar/mobile drawer
- Dark mode with localStorage
- User/customer table

## Setup
Requirements: PHP 8.2+, Composer, SQLite extension (or configure MySQL).

```bash
cp .env.example .env
composer install
php artisan key:generate
mkdir -p database
# create an empty file named database/database.sqlite
php -r "touch('database/database.sqlite');"
php artisan migrate --seed
php artisan serve
```

Open `http://127.0.0.1:8000/login`.

### Demo credentials
Email: `admin@example.com`
Password: `password`

## Testing
See `TESTING-NOTES.md` for the login/logout, route protection, filters, search, sorting, dark mode and responsive checks.

## Deployment
For traditional Laravel hosting, point the document root to `public/`, set production `.env`, use a persistent database, run migrations/seeding, and make `storage/` and `bootstrap/cache/` writable. Do not use GitHub Pages for this Laravel application because it needs PHP/server-side routing.

## Recording script (2 minutes)
0:00–0:20 Login with demo account and show protected dashboard.
0:20–0:45 Change 30 days → 7/90 days and show KPI/chart updates.
0:45–1:05 Show charts/funnel.
1:05–1:25 Search and sort transactions.
1:25–1:45 Toggle dark mode and mobile drawer.
1:45–2:00 Logout, show redirect to login, then summarize architecture.

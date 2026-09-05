# Testing Notes

## Authentication
1. Open `/dashboard` while logged out → should redirect to `/login`.
2. Login with `admin@example.com` / `password` → should reach `/dashboard`.
3. Submit an invalid password → validation/auth error appears; user remains on login.
4. Logout → session is invalidated and user is redirected to `/login`.
5. Press browser Back after logout and try `/dashboard` → should require authentication again.

## Dashboard
1. Change date filter 30 → 7 → KPI values, charts and funnel values change.
2. Change 7 → 90 → displayed period and datasets update.
3. Search transaction by customer/reference → matching rows only.
4. Click Customer/Reference/Date/Amount/Status table headers → rows sort ascending/descending.
5. Toggle dark mode → theme persists after refresh.
6. Resize to mobile → sidebar becomes drawer, tables stay horizontally scrollable and cards stack.
7. Use an unmatched search string → empty-state message appears.

## Security basics
- CSRF protection enabled on login/logout forms.
- Authenticated routes use the `auth` middleware.
- Session regenerated after successful login.
- Session invalidated and CSRF token regenerated on logout.
- Password stored hashed through Laravel's cast.

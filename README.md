# GolfBangers Web

Live golf scorecard web app for Ciputra Golf Surabaya (PWA + live score).

## Stack

- PHP 8.1 + MySQL
- Nginx
- Progressive Web App (`manifest.webmanifest`, `sw.js`)

## Setup (local / staging)

1. Copy config samples:
   - `cp config.sample.php config.php`
   - `cp online/config.sample.php online/config.php`
2. Fill MySQL credentials in both `config.php` files.
3. Import schema: `online/schema.sql`
4. Point web root to this directory.

## Branch

- `main` — production (`golfbangers.com` / `golfbangers.my.id`)

## Notes for collaborators

- Work directly on `main` (or open a PR into `main`).
- Do **not** commit `config.php` (ignored).
- Runtime PWA icons are in `/icons`.
- Master passwords for monitor list are currently in `api.php` (`viewerKey` / `superAdminKey`).

# PCOS - Pui Ching Ordering System

A web app for pre-ordering school canteen lunches. Students sign in with their school Google account, pick a set meal or build a cart noodle order for the next day, and get an email confirmation. Canteen staff and admins set the menu and see who ordered what.

Built with plain PHP, MySQL and Google sign-in (OAuth 2.0).

While it was live, PCOS served 1,000+ users per day. The site is no longer running; this repository is an archive of the project.

## Pages

| Page | Who | What it does |
|---|---|---|
| `redirect.php` | Everyone | Login page ("Sign in with Google") and OAuth callback |
| `index.php` | Students | Announcements, instructions and the week's menu |
| `order.php` → `finish.php` | Students | Order a set meal; sends a confirmation email |
| `cart_noodle.php` → `finishCartNoodle.php` | Students | Build and order a cart noodle bowl |
| `history.php` / `cancel_order.php` | Students | See past orders and cancel an order |
| `setting.php` / `setting_action.php` | Admins | Set food name, price and quantity for each set for a given day |
| `develop.php` / `adminordering.php` | Admins | Order list and totals for a given day |
| `lunchtime.php` | Admins | Order list used at lunchtime |
| `help.php`, `about.php`, `FAQ.php` | Everyone | Help, credits and FAQ |

## Order flow

1. Canteen staff set the whole week's meals on the Setting page.
2. Students order before 08:00 on the day (ordering opens 15:35 the day before).
3. Students pay at the canteen and get a printed ticket. Orders not paid before lunch are marked cancelled.
4. Students exchange the ticket for their meal at lunch.

## Setup

Requirements: PHP 7.0+ with `mysqli`, MySQL/MariaDB, Apache (or any PHP-capable server) and [Composer](https://getcomposer.org/).

```bash
composer install
cp config.example.php config.php
```

Then edit `config.php`:

- **Database**: host, user, password and database name. The app uses the tables `food_menu`, `orderlist` and `student_order`.
- **Google sign-in**: create an OAuth client (type "Web application") in Google Cloud Console and add `.../redirect.php` as an authorised redirect URI.
- **SMTP**: an account that can send the order confirmation emails (for Gmail, use an App Password).
- **Admins**: student IDs and email addresses that get the Setting, Status and Lunchtime pages.

`config.php` is in `.gitignore`. Never commit it.

## Files

- `config.example.php`: settings template (copy it to `config.php`)
- `db.php`: opens the MySQL connection (`$link`) using `config.php`
- `nav.php`: shared navigation bar; admin links show when `$_SESSION["admin"]` is set at login
- `assets/`: logo and favicon
- `changelog_PCOS.md`: change history

<?php
/*
 * PCOS settings template.
 * Copy this file to config.php and fill in real values.
 * config.php is listed in .gitignore, so it never gets committed.
 */

// MySQL database
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'your-db-user');
define('DB_PASSWORD', 'your-db-password');
define('DB_NAME', 'canteen');

// Google sign-in (OAuth client from Google Cloud Console > APIs & Services > Credentials)
define('GOOGLE_CLIENT_ID', 'your-client-id.apps.googleusercontent.com');
define('GOOGLE_CLIENT_SECRET', 'your-client-secret');
define('GOOGLE_REDIRECT_URI', 'https://example.com/canteen/redirect.php');

// Order confirmation emails (SMTP)
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 25);
define('SMTP_USERNAME', 'sender@example.com');
define('SMTP_PASSWORD', 'your-smtp-or-app-password');
define('MAIL_FROM', 'sender@example.com');
define('MAIL_FROM_NAME', 'PCOS Canteen');

// Site details used in emails
define('SITE_URL', 'https://example.com/canteen');          // no trailing slash
define('SUPPORT_EMAIL', 'support@example.com');
define('SCHOOL_EMAIL_DOMAIN', 'example.edu');                // students sign in as <id>@this-domain

// Admins: users matching either list get the Setting / Status / Lunchtime pages
const ADMIN_STUDENT_IDS = ['00000000'];
const ADMIN_EMAILS = ['teacher@example.edu'];

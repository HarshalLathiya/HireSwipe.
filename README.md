# Easy Employment — PHP Session Demo

A responsive job recruitment website built with PHP, HTML, CSS, and JavaScript. This version intentionally uses **static seed data and PHP sessions**; it does not require MySQL or any database.

## Requirements
- PHP 8.2 or newer (PHP 8.1 may work if `str_contains` and `mbstring` are enabled)
- A web browser

## Run locally

From this folder, run:

```bash
php -S localhost:8000
```

Then open `http://localhost:8000`.

You can also place the folder inside `htdocs` and open it through XAMPP Apache.

## Demo accounts

**Employee**
- Email: `employee@demo.com`
- Password: `Demo123!`

**Employer**
- Email: `employer@demo.com`
- Password: `Demo123!`

You can also create a demo account using Sign Up. Accounts, applications, job posts, profile changes, and notification preferences are stored in the current PHP session. They are temporary and may disappear when the session expires or the browser session is reset.

## Included workflows
- Sign in and sign up with server-side validation
- Employee/employer role selection and onboarding
- Employee home, job search, filters, job detail, and apply action
- Application activity and interview placeholder view
- Profile and edit profile
- Notification list and preferences
- Subscription plan selection (no payment integration)
- Employer workspace, candidate search, and job posting
- Sample location selector
- Responsive layout, mobile navigation, validation feedback, modals, and toast messages

## Important demo limitations
- No database is used.
- Google/Facebook OAuth is not configured; buttons explain this rather than simulating success.
- Map selection uses sample locations. Google Maps requires an API key and integration.
- File inputs are preview-only. Files are not uploaded or stored.
- Subscription prices are illustrative. No payment is taken and no plan is activated.
- Candidate records and job listings are sample data.
- This is a functional local prototype, not production-ready for real personal information. Before production, add persistent storage, real verification, secure file storage, logging, rate limiting, deployment hardening, and privacy/legal review.

## Notes
- All form actions are handled in `app.php` and `index.php`.
- Page templates are under `pages/`.
- Styling is in `assets/css/style.css`.
- Client-side interactions and validation are in `assets/js/app.js`.

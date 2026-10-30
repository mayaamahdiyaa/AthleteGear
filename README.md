# AthleteGear

AthleteGear is a web-based sports equipment management system built with Laravel and MariaDB/MySQL. It helps manage sports equipment, equipment categories, and borrowing transactions.

## Features

- User authentication and session management
- Role-based access for administrators and athletes
- Role-aware navigation sidebar (the Categories link is only visible to administrators)
- Equipment management (create, view, update, and delete)
- Equipment category management
- Borrowing transaction management
- Borrowing status and return date tracking
- Profile management

## Tech Stack

- **Backend:** PHP 8.2+ and Laravel 12
- **Frontend:** Blade templates with external CSS built by Vite, plus JavaScript for in-page interactions
- **Database:** MySQL or MariaDB (also compatible with MySQL-compatible services such as TiDB Cloud)
- **Local Development:** XAMPP and Composer
- **Frontend Tooling:** Node.js, npm, and Vite

## Database Structure

The application uses four main relational tables:

- `users`: Stores user accounts. The `role` column holds `admin` or `athlete` and defaults to `athlete`.
- `categories`: Stores equipment categories.
- `equipment`: Stores sports equipment and stock information.
- `borrowings`: Stores equipment borrowing transactions.

The relationships between the tables are:

- `equipment.category_id` references `categories.id`.
- `borrowings.user_id` references `users.id`.
- `borrowings.equipment_id` references `equipment.id`.

The database SQL export is expected at `database/athletegear.sql`.

## Requirements

- PHP version compatible with the Laravel version used by this project
- Composer
- Node.js and npm
- MariaDB/MySQL
- Git
- XAMPP or another local PHP and database environment

## Installation and Setup

### 1. Clone the Repository

Clone or download the AthleteGear repository, then open a terminal in the project directory.

```bash
git clone https://github.com/mayaamahdiyaa/AthleteGear.git
cd AthleteGear
```

### 2. Install Dependencies

Install the PHP dependencies:

```bash
composer install
```

Install the frontend dependencies:

```bash
npm install
```

### 3. Configure the Environment

Copy `.env.example` to `.env`.

On Windows:

```powershell
copy .env.example .env
```

On macOS/Linux:

```bash
cp .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

### 4. Configure the Database

1. Start Apache and MySQL from XAMPP.
2. Open phpMyAdmin.
3. Create a database named `athletegear`.
4. Configure the database connection in `.env` using the credentials for your local environment.

Example configuration:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=athletegear
DB_USERNAME=root
DB_PASSWORD=
```

Adjust the username and password if your local database uses different credentials.

### 5. Run Migrations and Seed the Database

Create the database tables and seed the default accounts:

```bash
php artisan migrate
php artisan db:seed
```

The `UserSeeder` creates two accounts (see [Demo Accounts](#demo-accounts)). It uses `firstOrCreate`, so re-running the seeder is safe and will not duplicate accounts or reset existing passwords.

Alternatively, you can import the SQL export at `database/athletegear.sql` if it is available. **Important:** Back up any existing database before importing, as the export may contain table-drop statements that replace existing data.

### 6. Build the Frontend Assets

All styles are external CSS files compiled by Vite. Build them before starting the application:

```bash
npm run build
```

For active development, run the Vite dev server in a separate terminal instead (it watches for changes and reloads automatically):

```bash
npm run dev
```

Re-run `npm run build` after changing any CSS file, or the served pages will use the old styles.

### 7. Run the Application

Start the Laravel development server:

```bash
php artisan serve
```

Open the local URL displayed by Laravel, typically `http://127.0.0.1:8000`.

Keep the relevant development processes running while testing the application.

## Environment Configuration

Use `.env.example` as the configuration template and set the appropriate values in `.env`.

Do not commit `.env`, real passwords, API keys, or other sensitive credentials to the repository.

## Demo Accounts

The database seeder (`php artisan db:seed`) creates two accounts for local development:

| Role | Email | Password |
|------|-------|----------|
| Admin | `admin@athletegear.test` | `password` |
| Athlete | `athlete@athletegear.test` | `password` |

Change or remove these accounts before deploying to a production environment.

## Frontend Structure

All page styles are external CSS files loaded through Vite (`@vite` in each Blade view). There are no inline `<style>` blocks in the views.

- `resources/css/app.css` — Tailwind CSS entry (used by the landing and profile pages).
- `resources/css/shared.css` — shared styles used across pages (design tokens, sidebar, topbar, buttons, tables, badges, flash messages).
- `resources/css/pages/*.css` — page-specific styles, one file per view (e.g. `dashboard.css`, `equipment-index.css`).
- `resources/views/components/sidebar.blade.php` — shared sidebar component, used in the views via `<x-sidebar />`. The active menu item follows the current route, and the Categories link is only shown to administrators.

When editing styles: change the relevant file under `resources/css/`, then run `npm run build` (or keep `npm run dev` running during development). If you add a new page CSS file, also add it to the `input` list in `vite.config.js` and reference it from the view with `@vite`.

## Project Structure

```text
AthleteGear/
├── app/                 # Models, controllers, and middleware
├── database/
│   ├── migrations/      # Database migrations
│   ├── seeders/         # Database seeders (UserSeeder: admin & athlete accounts)
│   └── athletegear.sql  # Database export, if included
├── public/              # Public assets and entry point (built assets in public/build)
├── resources/
│   ├── css/             # External CSS (app.css, shared.css, pages/*.css)
│   ├── js/              # Frontend JavaScript
│   └── views/           # Blade templates
│       └── components/  # Reusable Blade components (sidebar)
├── routes/
│   └── web.php          # Web routes
├── tests/               # Automated tests (PHPUnit)
├── vite.config.js       # Vite build configuration (CSS/JS entries)
├── .env.example         # Environment configuration template
├── composer.json        # PHP dependencies and scripts
├── package.json         # Frontend dependencies and scripts
├── README.md            # Project documentation
└── SECURITY_NOTES.md    # Security documentation
```

The actual project structure may contain additional files and directories.

## Testing

Run the automated tests with:

```bash
php artisan test
```

The view layer is covered by `tests/Feature/ViewRefactorSmokeTest.php`, which verifies that every page renders without inline styles, loads the external CSS bundle, and shows the correct sidebar (including hiding Categories from non-admin users). This test requires a frontend build (`npm run build`) and skips itself if no build output exists.

## License

This project was developed for academic purposes.
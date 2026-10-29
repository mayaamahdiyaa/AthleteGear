# AthleteGear

AthleteGear is a web-based equipment management system built with Laravel and MariaDB/MySQL. The application helps manage sports equipment, equipment categories, and borrowing transactions.

## Features

- User authentication and session management
- Role-based access for administrators and athletes
- Equipment management (create, view, update, and delete)
- Equipment category management
- Borrowing transaction management
- Borrowing status and return date tracking
- Profile management

## Tech Stack

- **Backend:** PHP and Laravel
- **Frontend:** Blade templates, HTML, CSS, and JavaScript
- **Database:** MariaDB/MySQL
- **Local development:** XAMPP and Composer

## Database Structure

The application uses four main relational tables:

- `users`: stores user accounts and roles
- `categories`: stores equipment categories
- `equipment`: stores sports equipment and stock information
- `borrowings`: stores equipment borrowing transactions

The `equipment` table references `categories`, while `borrowings` references `users` and `equipment`.

The SQL database export is available at `database/athletegear.sql`.

## Requirements

- PHP version compatible with the Laravel version used by this project
- Composer
- Node.js and npm
- MariaDB/MySQL
- Git

## Installation

1. Clone or download this repository.
2. Open a terminal in the project directory.
3. Install PHP dependencies:

   ```bash
   composer install
   ```

4. Install frontend dependencies:

   ```bash
   npm install
   ```

5. Copy the environment template:

   ```bash
   copy .env.example .env
   ```

   On macOS/Linux, use `cp .env.example .env`.

6. Generate the application key:

   ```bash
   php artisan key:generate
   ```

7. Create a database named `athletegear` in MariaDB/MySQL.
8. Configure the database connection in `.env`.
9. Import `database/athletegear.sql` into the `athletegear` database.
10. Start the application:

    ```bash
    php artisan serve
    ```

11. In another terminal, run the frontend development server if required:

    ```bash
    npm run dev
    ```

12. Open the local URL displayed by Laravel in your browser.

**Note:** Import the SQL dump into an empty database. Do not import it on top of an existing database containing the same tables unless you have backed it up.

## Environment Configuration

Use `.env.example` as a template. Set your own database credentials and application settings in `.env`.

Never commit real passwords, API keys, or other secrets to the repository.

## Default Login

Use the account credentials provided separately by the project owner or instructor. Do not publish real account passwords in this README.

## Project Structure

- `app/` — application models and controllers
- `database/migrations/` — database table definitions
- `database/seeders/` — database seeders
- `resources/views/` — Blade view templates
- `routes/web.php` — web routes
- `public/` — public assets and application entry point

## License

This project was developed for academic purposes.
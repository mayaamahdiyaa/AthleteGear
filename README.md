# AthleteGear

AthleteGear is a web-based sports equipment management system built with Laravel and MariaDB/MySQL. It helps manage sports equipment, equipment categories, and borrowing transactions.

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
- **Local Development:** XAMPP and Composer
- **Frontend Tooling:** Node.js and npm

## Database Structure

The application uses four main relational tables:

- `users`: Stores user accounts and roles.
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

### 5. Import the Database

Import `database/athletegear.sql` into the `athletegear` database using phpMyAdmin or the MySQL command line.

**Important:** Back up any existing database before importing. If the SQL file contains table-drop statements, importing it may replace existing tables and data.

If the SQL file is unavailable, verify the project's migrations and setup instructions before creating the database structure.

### 6. Run the Application

Start the Laravel development server:

```bash
php artisan serve
```

If the project uses Vite for frontend assets, open another terminal and run:

```bash
npm run dev
```

Open the local URL displayed by Laravel, typically `http://127.0.0.1:8000`.

Keep the relevant development processes running while testing the application.

## Environment Configuration

Use `.env.example` as the configuration template and set the appropriate values in `.env`.

Do not commit `.env`, real passwords, API keys, or other sensitive credentials to the repository.

## Demo Account

Use the demo account credentials provided separately by the project owner or instructor.

## Project Structure

```text
AthleteGear/
├── app/                 # Application models, controllers, and logic
├── database/
│   ├── migrations/      # Database migrations
│   ├── seeders/         # Database seeders
│   └── athletegear.sql  # Database export, if included
├── public/              # Public assets and entry point
├── resources/
│   └── views/           # Blade templates
├── routes/
│   └── web.php          # Web routes
├── .env.example         # Environment configuration template
├── composer.json        # PHP dependencies and scripts
├── package.json         # Frontend dependencies and scripts
└── README.md            # Project documentation
```

The actual project structure may contain additional files and directories.

## License

This project was developed for academic purposes.
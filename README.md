# Book Store App

A simple Book Store application built with Laravel.

## Prerequisites

Before setting up the project, ensure the following requirements are met:

* PHP 8.3 or later
* Composer
* MySQL 8.0 or later (the application should also work with older MySQL 8.x versions)
* Git

> Refer to the `composer.json` file for the exact framework and package version requirements.

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/gopi-s-2k/book-store.git
cd book-store
```

### 2. Create a Database

Create a MySQL database:

```sql
CREATE DATABASE book_store;
```

### 3. Configure Environment Variables

I will provide my env file which has my 'Weather API' key


Edit the `.env` file and set the appropriate database credentials:

```env
DB_DATABASE=book_store
DB_USERNAME=your_username
DB_PASSWORD=your_password
WEATHER_API_KEY=********************
WEATHER_API_BASE_URL=**************
```

### 4. Install Dependencies

```bash
composer install
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Run Database Migrations

```bash
php artisan migrate
```

### 7. Create the Default Admin Account

Run the custom Artisan command:

```bash
php artisan admin:create-base
```

### 8. Create the Storage Symlink

To make uploaded files accessible through public URLs:

```bash
php artisan storage:link
```

### 9. Start the Application

```bash
php artisan serve
```

The application will be available at:

```text
http://localhost:8000
```

## Notes

* Uploaded files are stored using Laravel's public storage disk.
* The `admin:create-base` command creates a default administrator account for initial access.
* Ensure the web server has the necessary permissions to write to the `storage` and `bootstrap/cache` directories.

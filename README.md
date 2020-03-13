# Timeclock

# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/7.x#installation)


Clone the repository

    git clone git@github.com:garrlker/timeclock.git

Switch to the repo folder

    cd timeclock

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Run the database seed (**Set the database connection in .env before migrating**)

    php artisan db:seed

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

**TL;DR command list**

    git clone git@github.com:garrlker/timeclock.git
    cd timeclock
    composer install
    cp .env.example .env
    php artisan key:generate
    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan db:seed
    php artisan serve

## Folders

- `app` - Contains the TimeclockEntry and User models
- `app/Http/Controllers` - Contains the Timeclock controller
- `app/Http/Middleware` - Contains the LoginAsGuest middleware
- `database/migrations` - Contains all the database migrations
- `database/seeds` - Contains the database seeder
- `routes` - Contains all the api routes defined in api.php file

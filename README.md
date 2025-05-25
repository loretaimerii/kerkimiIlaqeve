A Project To Search NDC Codes

A simple project to search for ndc codes for drugs. Codes can be entered separated by comma and results will be shown in a table and also they can be downloaded as a csv file. All the ndc codes found will be stored in the local database.

## Setup Instructions

### 1. Requirements:

PHP (version 7.x or higher)
Composer
MySQL or a compatible database
Laravel

### 2. Steps to Setup the Project

    1. Clone the repository: git clone https://github.com/loretaimerii/kerkimiIlaqeve.git
       cd kerkimiIlaqeve
    2. Install dependencies: Use Composer to install all required packages: composer install
    3. Configure environment variables: Copy the .env.example file to .env: cp .env.example .env, and configure the database connection, chnange these lines
       DB_CONNECTION=mysql
       DB_HOST=127.0.0.1
       DB_PORT=3306
       DB_DATABASE=kerkimiilaqeve
       DB_USERNAME=root
       DB_PASSWORD=
    4. Generate application key: Run the following command to generate an application key: php artisan key:generate
    5. Set up the database: Run the migrations to create the necessary database tables: php artisan migrate
    6. Run the application: Start the application locally using: php artisan serve

## Project Structure

app/: Contains the application's core logic, including models and controllers. resources/views/: Contains the Blade template views for rendering the HTML. routes/web.php: Defines the routes for the application (e.g., home, register, login). database/migrations/: Contains the migration files used to create and update the database schema.

## Features implemented

Authentication: User registration, User login and logout, Laravel's built-in authentication via Laravel Breeze Session-based access control
Authenticated users can: search for ndc codes, delete some of them from local database and download the results into a csv file.
Homepage Lists an input field to search ndc codes, separated with comma

## Future improvements

Add filters (e.g., by labeler_name, product_type)
View detailed drug information on a separate page
Track which drugs are searched the most

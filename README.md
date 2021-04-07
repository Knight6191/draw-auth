# Draw Auth

The pattern-based authorization system

## Requirements
* laravel >= 5.3
* php >= 5.6
* composer
* mysql

## Installation
Clone the repository

    git clone https://github.com/Knight6191/draw-auth.git

Switch to the repo folder

    cd draw-auth

Install all the dependencies using composer

    composer install
    
Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env
    
Create database mysql

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate
    
Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

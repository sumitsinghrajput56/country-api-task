<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

----------

# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/12.x/installation#installation)

Clone the repository

    git clone https://github.com/sumitsinghrajput56/country-api-task.git

Switch to the repo folder

    cd country-api-task

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

**TL;DR command list**

    git clone git@github.com:gothinkster/country-api-task.git
    cd country-api-task
    composer install
    cp .env.example .env
    php artisan key:generate
    
> **_NOTE:_**  **Make sure you set the correct database connection information before running the migrations**

    php artisan migrate
    php artisan serve

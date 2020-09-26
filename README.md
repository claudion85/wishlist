
# Getting started
## Installation

Clone the repository

    https://github.com/claudion85/wishlist.git

Switch to the repo folder

    cd wishlist

Build Docker image

    docker-compose up -d

Install Laravel dependancies

    docker exec <container_name> composer install

Enter in container shell

    docker exec -ti <container_name> /bin/bash

Create .env file

    cp .env.example .env

Edit .env file and set db connection like this

    DB_CONNECTION=mysql
    DB_HOST=<db container name >
    DB_PORT=3306
    DB_DATABASE=dbname
    DB_USERNAME=dbuser
    DB_PASSWORD=654321

Migrate files

    php artisan migrate

Install Laravel Passport

    php artisan passport:install

Set the right permissions to storage and bootstrap folders

    chown -R $USER:www-data storage
    chown -R $USER:www-data bootstrap/cache
    chmod -R 775 storage
    chmod -R 775 bootstrap/cache

Generate new key

    php artisan key:generate

Seed database with 50 products

    php artisan db:seed --class="ProductSeeder"

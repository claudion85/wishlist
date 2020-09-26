
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

Seed database with 50 fake products for test

    php artisan db:seed --class="ProductSeeder"

The address of application is

    http://your_ip_address:8080
## Api Documentation

### Register a new User and retreive the Access-Token

    Method:POST
    Endpoint: /api/register

    Mandatory Fields:
    name
    email
    password


    Response: 
     {
    "user": {
        "name": "your_name",
        "email": "your_email",
        "updated_at": "2020-09-26T14:33:21.000000Z",
        "created_at": "2020-09-26T14:33:21.000000Z",
        "id": 2
    },
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMWM1MTAwZjJhMDE4NThlMjFhNWFiODNiMWMyNjVhZWM1NzcwOTZjZDU4MGRjZjdkOWY5MDY4N2IyNGUzZWE2YTE2YzJiMzBmNzFjOGFkOTciLCJpYXQiOjE2MDExMzA4MDEsIm5iZiI6MTYwMTEzMDgwMSwiZXhwIjoxNjMyNjY2ODAxLCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.O7509HFbTdJAGfvK-4N5gn7o7o0zGS-n5L00doZH4QU9O2DONZZz0k4L42OmaEeoEAsefBQ6gaU2yz9JQYCd6kAo8MH5fOTYcsw4LYz7XPGadbrPoFaFbW8Uqstz6jRvKySHo50vIWhvRY-gco7kruOhQZOiE_C4E3w4XFGo88fcXwUjqyO4fxAOOZ-4v7GR_ZbA0n1pgXN-SOod2jepVjW1IINN7OAlP0qGEr-SnOTzQ-oqv7rm1bDgaFyoBA5YLUyqI06bXMVbOAvB0SV7H7_Gp6CPzw_Ej1mFpizRZeuzBstsZ7Rh50bZDEVFfyVFeRqwOXOb3quyhRYVMtA0b0XwA6Gtps5zvqumPAknBeqlth-QmXId-ZlaN2WDDeABqZBZyFrElrN6i1CgDGuoTzQ410HO6UU89Yhfph72Gpv1rusbZLMkbSGu_VRwDwufxuRiPjzncAEpP3CnxUrabsl9qz1shFA7eO4sglp-9eYB56defpbkjplo9B4K1ANmXkJ04LMTKBpVUY-iftUaf2hfJR1aT1H-oEum6R6jvGWCfYcKxuvClGJkOMjjEoUraTz0SoEOcSlGNSgyQaMms0ebyg7AgULGfONHY9hYPPYPk7d7hVeXhTvYRavgUH5uKTUAgoa9iGwUGhi5raIF4-jOc2PjiAKo0Y9SuvDSXfc"
}

Set the Authentication with:

    Bearer : AccessToken


### List all products

    Method:GET
    Endpoint: /api/products

    Mandatory Fields:
    name
    email
    password

    Response:
    [
    {
        "id": 1,
        "product_name": "saepe",
        "product_price": 0,
        "created_at": "2020-09-26T14:31:11.000000Z",
        "updated_at": "2020-09-26T14:31:11.000000Z"
    },
    {
        "id": 2,
        "product_name": "recusandae",
        "product_price": 5,
        "created_at": "2020-09-26T14:31:11.000000Z",
        "updated_at": "2020-09-26T14:31:11.000000Z"
    },
    {
        "id": 3,
        "product_name": "sit",
        "product_price": 8,
        "created_at": "2020-09-26T14:31:11.000000Z",
        "updated_at": "2020-09-26T14:31:11.000000Z"
    },
    
    ]

### Create new wishlist

    Method:POST
    Endpoint: /api/wishlist

    Mandatory Fields:
    wishlist_name
    items [ comma separated product ids e.g = 1,2,3]
    

    Response 

      {
        "message": "item added successfully"
      }


### List all wishlist of user

    Method:GET
    Endpoint: /api/wishlist

    Response:
      {
    "id": 2,
    "name": "your name",
    "email": "your email",
    "email_verified_at": null,
    "created_at": "2020-09-26T14:33:21.000000Z",
    "updated_at": "2020-09-26T14:33:21.000000Z",
    "wishlist": [
        {
            "id": 1,
            "wishlist_name": "example wishlist name",
            "user_id": 2,
            "items": [
                {
                    "id": 31,
                    "product_name": "optio",
                    "product_price": 3,
                    "created_at": "2020-09-26T14:31:11.000000Z",
                    "updated_at": "2020-09-26T14:31:11.000000Z"
                },
                {
                    "id": 45,
                    "product_name": "esse",
                    "product_price": 7,
                    "created_at": "2020-09-26T14:31:11.000000Z",
                    "updated_at": "2020-09-26T14:31:11.000000Z"
                },
                {
                    "id": 65,
                    "product_name": "quia",
                    "product_price": 3,
                    "created_at": "2020-09-26T14:40:41.000000Z",
                    "updated_at": "2020-09-26T14:40:41.000000Z"
                }
            ],
            "created_at": "2020-09-26T14:35:37.000000Z",
            "updated_at": "2020-09-26T14:35:37.000000Z"
        }
    ]
    }

## Export all wishlist in csv file 

    php artisan command:export_csv 

  the csv file is in storage/app/ folder



## PhpUnit tests
run

    vendor/bin/phpunit
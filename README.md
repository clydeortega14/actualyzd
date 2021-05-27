# Actualyzd Web Application

Actualyzd is built from laravel framework, the core of this system is to manage online bookings, schedules and sessions. Also able to make video call for on going session.

## Getting Started

clone the project repository

``` bash
git clone https://github.com/clydeortega14/actualyzd.git
```

install composer for package dependencies
``` bash
composer install
```

copy .env.example file and create new .env file for official environment variables
``` bash
cp .env.example .env
```

generate application key
``` bash
php artisan key:generate
```

install npm for front end package dependencies
``` bash
npm install
```

### Editing .env file for connecting to database
in order to connect the application to any mysql database, we must edit .env file and change the database credentials according to newly created connection.
assumed the you already know how to connect database to laravel project

Once the connection is completed, you must migrate the migrations / tables and also run the seeder for some default data
``` bash
php artisan migrate --seed
```

then start the server
``` bash

php artisan serve
```


<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# Instagram Api Laravel
Get your instagram feeds and share it !
***
![Laravel support v9, v10](https://img.shields.io/badge/Laravel%20Support-v9%2C%20v10-blue)
![Tests passing](https://img.shields.io/badge/Tests-passing-brightgreen)
![Licence](https://img.shields.io/badge/Licence-MIT-yellow)

## Installation
#### Install this package via Composer
```
composer require jusdepixel/instagram-api-laravel
```
#### Add service in config/app.php
```
Jusdepixel\InstagramApiLaravel\InstagramServiceProvider::class,
```
#### Run migration
```
php artisan migrate
```

## Configuration
#### Setting your Instagram application in .env
```
INSTAGRAM_CLIENT_ID=INSTAGRAM_CLIENT_ID
INSTAGRAM_CLIENT_SECRET=INSTAGRAM_CLIENT_SECRET
INSTAGRAM_REQUEST_URI=INSTAGRAM_REQUEST_URI
INSTAGRAM_ROUTES_PREFIX=INSTAGRAM_ROUTES_PREFIX
```

## Usage
#### Get your instagram app code first & get token
```
GET INSTAGRAM_ROUTES_PREFIX/init/url
GET INSTAGRAM_ROUTES_PREFIX/auth/login/INSTAGRAM_CODE
```
#### Routes
```
GET INSTAGRAM_ROUTES_PREFIX/init/url
GET INSTAGRAM_ROUTES_PREFIX/auth/code/{code}
GET INSTAGRAM_ROUTES_PREFIX/auth/login/{code}
GET INSTAGRAM_ROUTES_PREFIX/auth/logout
GET INSTAGRAM_ROUTES_PREFIX/auth/profile
GET INSTAGRAM_ROUTES_PREFIX/me/profile
GET INSTAGRAM_ROUTES_PREFIX/me/posts
GET INSTAGRAM_ROUTES_PREFIX/me/posts/{id}
POST INSTAGRAM_ROUTES_PREFIX/me/posts/{instagramId}
DELETE INSTAGRAM_ROUTES_PREFIX/me/posts/{post}
GET INSTAGRAM_ROUTES_PREFIX/posts
GET INSTAGRAM_ROUTES_PREFIX/posts/{id}
GET INSTAGRAM_ROUTES_PREFIX/users
GET INSTAGRAM_ROUTES_PREFIX/users/{user}
```
## Link
[Github instagram-api-laravel](https://github.com/jusdepixel/instagram-api-laravel)

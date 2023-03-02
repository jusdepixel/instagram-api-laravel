# Instagram Api Laravel
Get your instagram feeds and share them !
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
INSTAGRAM_ROUTES_PREFIX=instagram
```

## Usage
#### Get your instagram app code first & get token
```
GET     instagram/init/url
GET     instagram/auth/login/INSTAGRAM_CODE
```
#### Routes
```
GET     instagram/init/url
GET     instagram/auth/code/{code}
GET     instagram/auth/login/{code}
GET     instagram/auth/logout
GET     instagram/auth/profile
GET     instagram/me/profile
GET     instagram/me/posts
GET     instagram/me/posts/{id}
POST    instagram/me/posts/{instagramId}
DELETE  instagram/me/posts/{post}
GET     instagram/posts
GET     instagram/posts/{id}
GET     instagram/users
GET     instagram/users/{user}
```
## Link
[Github instagram-api-laravel](https://github.com/jusdepixel/instagram-api-laravel)  
[Packagist instagram-api-laravel](https://packagist.org/packages/jusdepixel/instagram-api-laravel)

# Instagram Api Laravel
Get your instagram feeds and share them !
***
![Laravel support v9, v10](https://img.shields.io/badge/Laravel%20Support-v9%2C%20v10-blue)
![Tests passing](https://img.shields.io/badge/Tests-passing-brightgreen)
![Licence](https://img.shields.io/badge/Licence-MIT-yellow)

## Configuration
#### Setting your Instagram application in .env
```
INSTAGRAM_CLIENT_ID=INSTAGRAM_CLIENT_ID
INSTAGRAM_CLIENT_SECRET=INSTAGRAM_CLIENT_SECRET
INSTAGRAM_REQUEST_URI=INSTAGRAM_REQUEST_URI
INSTAGRAM_ROUTES_PREFIX=api
```

## Installation
#### Install this package via Composer
```
composer require jusdepixel/instagram-api-laravel
```
#### Add service in config/app.php
```
Jusdepixel\InstagramApiLaravel\InstagramServiceProvider::class,
```
#### Add jobs in app/Console/Kernel.php
```
protected function schedule(Schedule $schedule): void
{
    /** ... */
    $schedule->job(new RefreshTokenJob)->daily();
}
```
#### Run migration
```
php artisan migrate
```

## Usage
#### Get your instagram app code first & get token
```
GET         api/init/url
GET         api/auth/login/INSTAGRAM_CODE
```
#### Routes
```
GET         api/init/url
GET         api/auth/code/{code}
GET         api/auth/login/{code}
GET         api/auth/logout
GET         api/auth/profile
GET         api/me/profile
GET         api/me/posts
GET         api/me/posts/{id}
POST        api/me/posts/{instagramId}
DELETE      api/me/posts/{post}
GET         api/posts
GET         api/posts/{id}
GET         api/users
GET         api/users/{user}
```
## Link
[Github instagram-api-laravel](https://github.com/jusdepixel/instagram-api-laravel)  
[Packagist instagram-api-laravel](https://packagist.org/packages/jusdepixel/instagram-api-laravel)

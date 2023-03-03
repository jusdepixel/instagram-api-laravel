# Instagram Api Laravel
Get your instagram feeds and share them !
***
![Laravel support v9, v10](https://img.shields.io/badge/Laravel%20Support-v9%2C%20v10-blue)
![Tests passing](https://img.shields.io/badge/Tests-passing-brightgreen)
![Licence](https://img.shields.io/badge/Licence-MIT-yellow)

## Configuration
#### Setting your Instagram application in .env
```
INSTAGRAM_ROUTES_PREFIX=api
INSTAGRAM_CLIENT_ID=INSTAGRAM_CLIENT_ID
INSTAGRAM_CLIENT_SECRET=INSTAGRAM_CLIENT_SECRET
INSTAGRAM_REQUEST_URI=INSTAGRAM_REQUEST_URI/INSTAGRAM_ROUTES_PREFIX/auth/code
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
    $schedule->job(new RefreshMediaJob)->daily();
}
```
#### Run migration
```
php artisan migrate
```

## Usage
#### Get your instagram app code first
```
GET /api/init/url
```
#### Return code
```
{"code":"INSTAGRAM_CODE"}
```
#### Then, get your token
```
POST /api/auth/login/INSTAGRAM_CODE
```
You are now logged, you could use routes !
#### Routes
```
See instagram-api-laravel.postman_collection.json
```
## Link
[Github instagram-api-laravel](https://github.com/jusdepixel/instagram-api-laravel)  
[Packagist instagram-api-laravel](https://packagist.org/packages/jusdepixel/instagram-api-laravel)

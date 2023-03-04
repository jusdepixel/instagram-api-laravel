<?php

use Illuminate\Support\Facades\Route;

Route:: middleware([
    \Illuminate\Session\Middleware\StartSession::class,
    \Illuminate\Routing\Middleware\ThrottleRequests::class.':api',
])
    ->prefix('/' . config('instagram.routes_prefix'))
    ->group(static function(): void {

        Route::get('/init/url',
            \Jusdepixel\InstagramApiLaravel\Http\Controllers\Init\AuthorizeUrlController::class)
            ->name('init@url');

        Route::prefix('/auth')->group(static function(): void {

            Route::get('/code',
                \Jusdepixel\InstagramApiLaravel\Http\Controllers\Auth\CodeController::class)
                ->name('auth@code');

            Route::get('/profile',
                \Jusdepixel\InstagramApiLaravel\Http\Controllers\Auth\ProfileController::class)
                ->name('auth@profile');

            Route::post('/login/{code}',
                \Jusdepixel\InstagramApiLaravel\Http\Controllers\Auth\LoginController::class)
                ->name('auth@login');

            Route::post('/logout',
                \Jusdepixel\InstagramApiLaravel\Http\Controllers\Auth\LogoutController::class)
                ->name('auth@logout');
        });

        Route::prefix('/me')
            ->middleware(\Jusdepixel\InstagramApiLaravel\Http\Middleware\Instagram::class)
            ->group(static function(): void {

                Route::get('/profile',
                    \Jusdepixel\InstagramApiLaravel\Http\Controllers\Me\ProfileController::class)
                    ->name('me@profile');

                Route::get('/posts',
                    \Jusdepixel\InstagramApiLaravel\Http\Controllers\Me\PostsController::class)
                    ->name('me@posts');

                Route::get('/posts/{id}',
                    \Jusdepixel\InstagramApiLaravel\Http\Controllers\Me\PostController::class)
                    ->name('me@post');

                Route::post('/posts/{instagram_id}',
                    \Jusdepixel\InstagramApiLaravel\Http\Controllers\Me\PostCreateController::class)
                    ->name('me@post.create');

                Route::delete('/posts/{id}',
                    \Jusdepixel\InstagramApiLaravel\Http\Controllers\Me\PostDeleteController::class)
                    ->name('me@post.delete');

                Route::delete('/delete',
                    \Jusdepixel\InstagramApiLaravel\Http\Controllers\Me\DeleteController::class)
                    ->name('me@delete');
            });

        Route::prefix('/posts')->group(static function(): void {

            Route::get('/',
                \Jusdepixel\InstagramApiLaravel\Http\Controllers\Posts\AllController::class, 'all')
                ->name('post@all');

            Route::get('/{id}',
                \Jusdepixel\InstagramApiLaravel\Http\Controllers\Posts\OneController::class)
                ->name('post@one');
        });

        Route::prefix('/users')->group(static function(): void {

            Route::get('/',
                \Jusdepixel\InstagramApiLaravel\Http\Controllers\Users\AllController::class)
                ->name('user@all');

            Route::get('/{user}',
                \Jusdepixel\InstagramApiLaravel\Http\Controllers\Users\OneController::class)
                ->name('user@one');
        });

        Route::prefix('/refresh')
            ->middleware(\Jusdepixel\InstagramApiLaravel\Http\Middleware\Instagram::class)
            ->group(static function(): void {

                Route::put('/token',
                    \Jusdepixel\InstagramApiLaravel\Http\Controllers\Refresh\TokenController::class)
                    ->name('refresh@token');

                Route::put('/post/{instagram_id}',
                    \Jusdepixel\InstagramApiLaravel\Http\Controllers\Refresh\PostController::class)
                    ->name('refresh@post');
            });
    });

# MoondepthLaravel

Imageboard.

Site: https://www.moondepth.space/ (Currently unavailable)

Based on Laravel framework

## Dev config

### Pre 1. Configurate mySQL (if local) and HTTP Server

### Pre 2. Install redis version >2.6.*

If windows environment :
> https://github.com/microsoftarchive/redis/releases

and start redis-server.exe (e.g. on port: 6379)

### 1. Install laravel

`composer global require laravel/installer`

### 2. Pull project

### 3. Open command line with project path

### 4. Init echo server config or pull one to ./

`laravel-echo-server init`

### 5. Pull .env config to ./ or create one from .env.example

### 6. Make sure that all is properly installed

`composer update`

`npm update`

### 7. Build javascript

`npm run dev`

### 8. Start laravel echo server on appropriate path

`laravel-echo-server start`

### 9. Start laravel server

`php artisan serve`
